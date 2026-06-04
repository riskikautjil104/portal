<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentDownload;
use App\Models\DocumentValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{

    public function index()
    {
        $documents = Document::query()
            ->where('active', true)
            ->latest()
            ->paginate(9);

        return view('public.documents.index', compact('documents'));
    }

    public function request(string $document)
    {
        $doc = Document::query()
            ->where('active', true)
            ->findOrFail($document);

        abort_unless($doc->requires_validation, 404);

        return view('public.documents.request', compact('doc'));
    }

    public function download(Request $request, string $document)
    {
        $doc = Document::query()
            ->where('active', true)
            ->findOrFail($document);

        if ($doc->requires_validation) {
            $fields = $doc->validation_fields_json ?? [];
            // Default fields expected by our schema
            $baseRules = [
                'full_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['nullable', 'string', 'max:50'],
                'institution' => ['nullable', 'string', 'max:255'],
                'position' => ['nullable', 'string', 'max:255'],
            ];

            // Additional dynamic fields (optional)
            $dynamicRules = [];
            foreach ($fields as $f) {
                if (!is_array($f) || empty($f['name'])) continue;
                $name = (string) $f['name'];
                $dynamicRules[$name] = ($f['required'] ?? false)
                    ? ['required', 'string', 'max:255']
                    : ['nullable', 'string', 'max:255'];
            }

            $validated = $request->validate($baseRules + $dynamicRules);

            // Create validation record (completed)
            $validation = DocumentValidation::create([
                'document_id' => $doc->id,
                'user_id' => (Auth::check() ? Auth::id() : null),
                'full_name' => $validated['full_name'],


                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'institution' => $validated['institution'] ?? null,
                'position' => $validated['position'] ?? null,
                'fields_json' => collect($validated)->except([
                    'full_name','email','phone','institution','position'
                ])->toArray(),
                'status' => 'completed',
            ]);

            // Log download
            $download = DocumentDownload::create([
                'document_id' => $doc->id,
                'validation_id' => $validation->id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'institution' => $validated['institution'] ?? null,
                'position' => $validated['position'] ?? null,
                'fields_json' => $validation->fields_json,
                'ip' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 500),
            ]);

            $doc->increment('download_total');

            return $this->streamDocument($doc);
        }

        // No validation required
            $download = DocumentDownload::create([
                'document_id' => $doc->id,
                'validation_id' => null,
                'user_id' => (Auth::check() ? Auth::id() : null),
                'full_name' => null,
                'email' => null,
            'ip' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
        ]);

        $doc->increment('download_total');

        return $this->streamDocument($doc);
    }

    protected function streamDocument(Document $doc)
    {
        // We store under public disk
        $path = $doc->file_path;
        $disk = 'public';

        if (!Storage::disk($disk)->exists($path)) {
            abort(404);
        }

        return Storage::disk($disk)->download($path, $doc->file_name ?: Str::of($path)->afterLast('/')->toString());
    }
}

