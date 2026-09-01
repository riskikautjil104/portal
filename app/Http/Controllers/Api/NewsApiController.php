<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsApiController extends Controller
{
    /**
     * Ambil daftar berita terbit untuk aplikasi mobile MORO⁵SMART
     */
    public function index(Request $request): JsonResponse
    {
        $query = News::with('user')
            ->where('status', 'published')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $perPage = (int) $request->input('per_page', 10);
        $paginated = $query->paginate($perPage);

        $items = collect($paginated->items())->map(function ($news) {
            return $this->formatNewsItem($news);
        });

        return response()->json([
            'status' => true,
            'message' => 'Daftar berita berhasil diambil',
            'data' => $items,
            'pagination' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'has_more' => $paginated->hasMorePages(),
            ],
        ]);
    }

    /**
     * Ambil 5 berita terbaru untuk carousel / widget beranda mobile
     */
    public function latest(): JsonResponse
    {
        $newsList = News::with('user')
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        $items = $newsList->map(function ($news) {
            return $this->formatNewsItem($news);
        });

        return response()->json([
            'status' => true,
            'message' => 'Berita terbaru berhasil diambil',
            'data' => $items,
        ]);
    }

    /**
     * Ambil detail lengkap artikel berita berdasarkan slug
     */
    public function show(string $slug): JsonResponse
    {
        $news = News::with('user')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (!$news) {
            return response()->json([
                'status' => false,
                'message' => 'Berita tidak ditemukan atau belum diterbitkan',
            ], 404);
        }

        // Berita terkait lainnya
        $related = News::where('status', 'published')
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($item) {
                return $this->formatNewsItem($item);
            });

        return response()->json([
            'status' => true,
            'message' => 'Detail berita berhasil diambil',
            'data' => array_merge($this->formatNewsItem($news), [
                'content_raw' => $news->content,
                'related_news' => $related,
            ]),
        ]);
    }

    /**
     * Helper untuk format seragam data berita
     */
    private function formatNewsItem(News $news): array
    {
        $imageUrl = null;
        if ($news->image) {
            if (Str::startsWith($news->image, ['http://', 'https://'])) {
                $imageUrl = $news->image;
            } else {
                $imageUrl = url('storage/' . $news->image);
            }
        }

        // Generate clean plain text summary
        $cleanText = strip_tags($news->content);
        $cleanText = preg_replace('/\s+/', ' ', $cleanText);
        $summary = Str::limit(trim($cleanText), 140);

        return [
            'id' => $news->id,
            'title' => $news->title,
            'slug' => $news->slug,
            'summary' => $summary,
            'content' => $news->content,
            'image_url' => $imageUrl,
            'author' => $news->user?->name ?? 'Humas SMAN 5',
            'created_at' => $news->created_at ? $news->created_at->toIso8601String() : null,
            'formatted_date' => $news->created_at ? $news->created_at->locale('id')->isoFormat('D MMMM Y') : '',
        ];
    }
}
