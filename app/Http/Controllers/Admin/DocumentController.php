<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::query()->latest()->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file_type' => ['required', 'string', 'max:50'],
            'active' => ['required', 'boolean'],
            'requires_validation' => ['required', 'boolean'],
            'validation_fields_json' => ['nullable', 'string'],
            'file' => ['required', 'file'],
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');

        $validationFieldsJson = $validated['validation_fields_json'] ?? null;
        $validationFields = null;
        if (!empty($validationFieldsJson)) {
            $decoded = json_decode($validationFieldsJson, true);
            $validationFields = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        $doc = Document::create([
            'created_by' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $validated['file_type'],
            'file_mime' => $file->getClientMimeType(),
            'active' => (bool) $validated['active'],
            'requires_validation' => (bool) $validated['requires_validation'],
            'validation_fields_json' => $validationFields,
        ]);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function edit(Document $document)
    {
        $doc = $document;
        return view('admin.documents.edit', compact('doc'));
    }

    public function update(Request $request, Document $document): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file_type' => ['required', 'string', 'max:50'],
            'active' => ['required', 'boolean'],
            'requires_validation' => ['required', 'boolean'],
            'validation_fields_json' => ['nullable', 'string'],
            'file' => ['nullable', 'file'],
        ]);

        $validationFieldsJson = $validated['validation_fields_json'] ?? null;
        $validationFields = null;
        if (!empty($validationFieldsJson)) {
            $decoded = json_decode($validationFieldsJson, true);
            $validationFields = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        $update = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_type' => $validated['file_type'],
            'active' => (bool) $validated['active'],
            'requires_validation' => (bool) $validated['requires_validation'],
            'validation_fields_json' => $validationFields,
        ];

        if ($request->hasFile('file')) {
            // delete old
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('documents', 'public');

            $update['file_path'] = $path;
            $update['file_name'] = $file->getClientOriginalName();
            $update['file_mime'] = $file->getClientMimeType();
        }

        $document->update($update);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy(Document $document): RedirectResponse
    {
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();
        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    public function show(Document $document)
    {
        $doc = $document->load(['validations', 'downloads']);
        return view('admin.documents.show', compact('doc'));
    }

    public function downloads(Document $document)
    {
        $doc = $document;
        $downloads = $doc->downloads()->latest()->paginate(15);
        return view('admin.documents.downloads', compact('doc', 'downloads'));
    }
}

