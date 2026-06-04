@extends('layouts.public')

@section('title', 'Berita - SMA Negeri 5 Morotai')

@push('styles')
<style>
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
    }

    /* ── Page Hero (Sama persis dengan halaman Pengumuman biar konsisten) ── */
    .page-hero {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        padding: 60px 60px;
        position: relative;
        overflow: hidden;
        color: white;
    }
    .page-hero::before {
        content: ''; position: absolute; top: -60px; right: -60px;
        width: 240px; height: 240px; border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .page-hero::after {
        content: ''; position: absolute; bottom: -80px; left: -40px;
        width: 200px; height: 200px; border-radius: 50%;
        background: rgba(74,144,226,0.10);
    }
    .page-hero-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: 2px;
        text-transform: uppercase; color: var(--blue-acc);
        background: rgba(74,144,226,0.15); border: 1px solid rgba(74,144,226,0.35);
        padding: 4px 14px; border-radius: 30px; margin-bottom: 16px;
        position: relative; z-index: 1;
    }
    .page-hero h1 {
        font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800;
        margin: 0 0 10px; position: relative; z-index: 1;
    }
    .page-hero p {
        font-size: 0.95rem; color: rgba(232,240,254,0.75);
        margin: 0; position: relative; z-index: 1; max-width: 600px;
    }

    /* ── News Card (Horizontal Layout) ── */
    .news-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26,58,107,0.06);
        box-shadow: 0 2px 10px rgba(26,58,107,0.03);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
        display: block;
        text-decoration: none;
        color: inherit;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(26,58,107,0.10);
        border-color: rgba(74, 144, 226, 0.3);
        color: inherit;
    }

    /* Image Container: Mencegah gambar gepeng/stretch */
    .news-thumb {
        width: 100%;
        height: 100%;
        min-height: 180px; /* Tinggi minimal di desktop */
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    
    .news-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .news-card:hover .news-thumb img {
        transform: scale(1.05); /* Efek zoom halus saat hover */
    }

    .news-meta {
        font-size: 0.78rem;
        color: #9ca3af;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .news-meta i { color: var(--blue-acc); }

    .news-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a202c;
        line-height: 1.4;
        margin-bottom: 12px;
        transition: color 0.2s ease;
    }

    .news-card:hover .news-title { color: var(--blue-dark); }

    .news-excerpt {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.65;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Batasi 2 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-read-more {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--blue-acc);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: gap 0.2s ease, color 0.2s ease;
    }

    .news-card:hover .news-read-more {
        gap: 8px;
        color: var(--blue-dark);
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 60px 24px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26,58,107,0.06);
    }
    .empty-state-icon {
        width: 64px; height: 64px; border-radius: 18px;
        background: #EEF3FC; color: var(--blue-acc);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; margin: 0 auto 18px;
    }

    /* ── Pagination (Sama dengan halaman pengumuman) ── */
    .pagination .page-link {
        border-radius: 10px !important; margin: 0 3px;
        border: 1.5px solid rgba(26,58,107,0.12);
        color: var(--blue-dark); font-weight: 600; font-size: 0.875rem;
        padding: 7px 14px; transition: all 0.2s ease;
    }
    .pagination .page-item.active .page-link,
    .pagination .page-link:hover {
        background: var(--blue-dark); border-color: var(--blue-dark); color: #ffffff;
    }

    /* ── Mobile Responsive ── */
    @media (max-width: 576px) {
        .news-thumb { min-height: 200px; margin-bottom: 16px; } /* Gambar lebih tinggi di HP */
        .page-hero { padding: 40px 0 60px; }
    }
</style>
@endpush

{{-- Pindahkan Header ke Hero Section biar nyatu sama layout --}}
@section('hero')
    <div class="page-hero">
            <div class="page-hero-eyebrow">
                <i class="bi bi-newspaper"></i>
                Portal Sekolah
            </div>
            <h1>Berita Terkini</h1>
            <p>Update terbaru seputar kegiatan, prestasi, dan dinamika SMA Negeri 5 Morotai.</p>
    </div>
@endsection

@section('content')
    <div  style="margin-bottom: 60px;">

        {{-- Search (realtime / client-side) --}}
        <div class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text" style="background:#fff;border-color:rgba(26,58,107,0.12);color:#1A3A6B;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input id="newsSearchInput" type="text" class="form-control"
                               placeholder="Cari berita... (judul/penulis/isi)" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted" style="font-size:0.85rem;">
                        Hasil pencarian ditampilkan saat kamu mengetik.
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($news as $item)
                <div class="col-12 news-item"
                     data-title="{{ strtolower($item->title ?? '') }}"
                     data-author="{{ strtolower($item->user->name ?? 'admin') }}"
                     data-content="{{ strtolower(strip_tags($item->content ?? '')) }}">
                    <a href="{{ route('news.show', $item->slug) }}" class="news-card p-3 p-md-4">
                        <div class="row g-3 g-md-4 align-items-center">

                            {{-- Kolom Gambar --}}
                            <div class="col-md-4">
                                @if($item->image)
                                    <div class="news-thumb shadow-sm">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy">
                                    </div>
                                @else
                                    {{-- Fallback jika tidak ada gambar --}}
                                    <div class="news-thumb shadow-sm d-flex align-items-center justify-content-center" style="background: #EEF3FC;">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Kolom Teks --}}
                            <div class="col-md-8 d-flex flex-column justify-content-center">
                                <div class="news-meta">
                                    <span><i class="bi bi-calendar3"></i> {{ $item->created_at->isoFormat('D MMMM Y') }}</span>
                                    <span class="text-muted">•</span>
                                    <span>Oleh: {{ $item->user->name ?? 'Admin' }}</span>
                                </div>

                                <h5 class="news-title">
                                    {{ $item->title }}
                                </h5>

                                <p class="news-excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}
                                </p>

                                <div class="news-read-more mt-auto">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <h5 style="font-weight: 700; color: #1a202c; margin-bottom: 8px;">Belum ada berita</h5>
                        <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">
                            Berita dan artikel terbaru akan muncul di sini saat tersedia.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($news->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        const input = document.getElementById('newsSearchInput');
        if (!input) return;

        const items = Array.from(document.querySelectorAll('.news-item'));

        const emptyState = document.createElement('div');
        emptyState.className = 'col-12';
        emptyState.style.display = 'none';
        emptyState.innerHTML = `
            <div class="empty-state" style="padding:45px 24px;">
                <div class="empty-state-icon"><i class="bi bi-search"></i></div>
                <h5 style="font-weight:700;color:#1a202c;margin-bottom:8px;">Tidak ada hasil</h5>
                <p style="font-size:0.875rem;color:#9ca3af;margin:0;">Coba kata kunci lain.</p>
            </div>
        `;

        const listRow = document.querySelector('.row.g-4');
        if (listRow) listRow.appendChild(emptyState);

        input.addEventListener('input', function () {
            const q = (input.value || '').trim().toLowerCase();
            let visible = 0;

            items.forEach(el => {
                const title = el.dataset.title || '';
                const author = el.dataset.author || '';
                const content = el.dataset.content || '';

                const match = !q || title.includes(q) || author.includes(q) || content.includes(q);
                el.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            emptyState.style.display = visible === 0 ? '' : 'none';
        });
    })();
</script>
@endpush
