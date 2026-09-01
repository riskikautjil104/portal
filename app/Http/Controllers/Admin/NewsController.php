<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Services\FcmService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('user')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news = News::create($validated);

        // Kirim Push Notification FCM ke seluruh pengguna (Siswa, Guru, Satpam) jika langsung diterbitkan
        if ($news->status === 'published') {
            try {
                \App\Services\FcmService::sendToTopic(
                    'all_users',
                    'Berita Baru: ' . $news->title,
                    Str::limit(strip_tags($news->content), 120),
                    [
                        'type' => 'news',
                        'slug' => (string) $news->slug,
                        'id' => (string) $news->id,
                        'title' => 'Berita Baru: ' . $news->title,
                    ]
                );
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('[FCM News Store] ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dibuat dan diterbitkan!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->title !== $news->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $wasDraft = $news->status !== 'published';
        $news->update($validated);

        // Jika berita baru saja diubah statusnya menjadi published, tembakkan notifikasi
        if ($wasDraft && $news->status === 'published') {
            try {
                \App\Services\FcmService::sendToTopic(
                    'all_users',
                    'Berita Baru: ' . $news->title,
                    Str::limit(strip_tags($news->content), 120),
                    [
                        'type' => 'news',
                        'slug' => (string) $news->slug,
                        'id' => (string) $news->id,
                        'title' => 'Berita Baru: ' . $news->title,
                    ]
                );
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('[FCM News Update] ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
