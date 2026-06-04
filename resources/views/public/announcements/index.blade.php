@extends('layouts.public')

@php use Illuminate\Support\Facades\Crypt; @endphp

@section('title', 'Pengumuman - SMA Negeri 5 Morotai')

@push('styles')
<style>
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
    }

    /* ── Page Header ── */
    .page-hero {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        /* border-radius: 20px; */
        padding: 60px 60px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .page-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 240px; height: 240px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .page-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(74,144,226,0.10);
    }

    .page-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--blue-acc);
        background: rgba(74,144,226,0.15);
        border: 1px solid rgba(74,144,226,0.35);
        padding: 4px 14px;
        border-radius: 30px;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .page-hero h1 {
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 10px;
        position: relative;
        z-index: 1;
    }

    .page-hero p {
        font-size: 0.95rem;
        color: rgba(232,240,254,0.75);
        margin: 0;
        position: relative;
        z-index: 1;
    }

    /* ── Filter Bar ── */
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 28px;
    }

    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 7px 16px;
        border-radius: 30px;
        border: 1.5px solid rgba(26,58,107,0.15);
        background: #ffffff;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
    }

    .filter-chip:hover {
        border-color: var(--blue-acc);
        color: var(--blue-dark);
    }

    .filter-chip.active {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(26,58,107,0.20);
    }

    .filter-chip .chip-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.6;
    }

    /* ── Announcement Cards ── */
    .ann-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .ann-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26,58,107,0.06);
        border-left: 4px solid var(--blue-acc);
        padding: 22px 24px;
        transition: all 0.25s ease;
        box-shadow: 0 2px 10px rgba(26,58,107,0.03);
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .ann-card:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 28px rgba(26,58,107,0.09);
        border-left-color: var(--blue-dark);
        color: inherit;
    }

    .ann-card-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }

    .ann-badge {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 3px 12px;
        border-radius: 30px;
    }

    .ann-date {
        font-size: 0.78rem;
        color: #9ca3af;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ann-date i { font-size: 0.8rem; }

    .ann-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 8px;
        line-height: 1.45;
    }

    .ann-excerpt {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.65;
        margin: 0 0 14px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .ann-read-more {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--blue-acc);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: gap 0.2s ease, color 0.2s ease;
    }

    .ann-card:hover .ann-read-more {
        gap: 8px;
        color: var(--blue-dark);
    }

    /* ── Sidebar ── */
    .sidebar-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26,58,107,0.06);
        box-shadow: 0 2px 10px rgba(26,58,107,0.03);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .sidebar-card-header {
        background: linear-gradient(135deg, var(--blue-dark), var(--blue-mid));
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-card-header i {
        font-size: 1.1rem;
        color: var(--blue-acc);
    }

    .sidebar-card-header span {
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        color: #ffffff;
    }

    .sidebar-card-body {
        padding: 18px 20px;
    }

    .sidebar-card-body p {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.7;
        margin: 0;
    }

    /* Category stats in sidebar */
    .cat-stat-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .cat-stat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.875rem;
    }

    .cat-stat-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4a5568;
        font-weight: 500;
    }

    .cat-stat-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .cat-stat-count {
        font-size: 0.78rem;
        font-weight: 700;
        color: #ffffff;
        background: var(--blue-dark);
        padding: 2px 10px;
        border-radius: 30px;
        min-width: 28px;
        text-align: center;
    }

    /* ── Pagination override ── */
    .pagination .page-link {
        border-radius: 10px !important;
        margin: 0 3px;
        border: 1.5px solid rgba(26,58,107,0.12);
        color: var(--blue-dark);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 7px 14px;
        transition: all 0.2s ease;
    }

    .pagination .page-item.active .page-link {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(26,58,107,0.25);
    }

    .pagination .page-link:hover {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: #ffffff;
    }

    /* ── Empty state ── */
    .empty-state {
        text-align: center;
        padding: 60px 24px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26,58,107,0.06);
    }

    .empty-state-icon {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: #EEF3FC;
        color: var(--blue-acc);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin: 0 auto 18px;
    }

    .empty-state h5 {
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 0.875rem;
        color: #9ca3af;
        margin: 0;
    }
        /* ── Mobile Filter Scroll ── */
    @media (max-width: 576px) {
        .filter-bar {
            flex-wrap: nowrap;          /* Jangan turun ke bawah */
            overflow-x: auto;           /* Bisa di-scroll ke samping */
            padding-bottom: 8px;        /* Ruang untuk scrollbar */
            -webkit-overflow-scrolling: touch; /* Scroll halus di iOS */
            scrollbar-width: none;      /* Sembunyikan scrollbar di Firefox */
        }
        .filter-bar::-webkit-scrollbar {
            display: none;              /* Sembunyikan scrollbar di Chrome/Safari */
        }
        .filter-chip {
            flex-shrink: 0;             /* Mencegah tombol mengecil/gepeng */
            white-space: nowrap;
        }
    }
</style>
@endpush
@section('hero')
 <div class="page-hero">
        <div class="page-hero-eyebrow">
            <i class="bi bi-megaphone"></i>
            Portal Sekolah
        </div>
        <h1>Pengumuman</h1>
        <p>Informasi terkini seputar kegiatan akademik, beasiswa, dan program sekolah.</p>
    </div>
    @endsection
@section('content')

    {{-- Page Hero --}}
   

    <div class="row g-4">

        {{-- Main Content --}}
        <div class="col-lg-8">

            {{-- Search + Filter Bar --}}
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text" style="background:#fff;border-color:rgba(26,58,107,0.12);color:#1A3A6B;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input id="announcementSearchInput" type="text" class="form-control"
                           placeholder="Cari pengumuman... (judul/kategori/isi)" autocomplete="off">
                </div>
            </div>

            <div class="filter-bar">
                <div class="filter-chip active" onclick="filterByCategory('all', this)">
                    <span class="chip-dot"></span> Semua
                </div>
                <div class="filter-chip" onclick="filterByCategory('umum', this)">
                    <span class="chip-dot"></span> Umum
                </div>
                <div class="filter-chip" onclick="filterByCategory('akademik', this)">
                    <span class="chip-dot"></span> Akademik
                </div>
                <div class="filter-chip" onclick="filterByCategory('beasiswa', this)">
                    <span class="chip-dot"></span> Beasiswa
                </div>
                <div class="filter-chip" onclick="filterByCategory('kegiatan', this)">
                    <span class="chip-dot"></span> Kegiatan
                </div>
            </div>

            {{-- Announcement List --}}
            <div class="ann-list" id="ann-list">
                @forelse($announcements as $announcement)
                    <a href="{{ route('announcements.show', ['encryptedAnnouncement' => Crypt::encryptString($announcement->id)]) }}"
                       class="ann-card"
                       data-category="{{ $announcement->category }}"
                       data-title="{{ strtolower($announcement->title ?? '') }}"
                       data-content="{{ strtolower(strip_tags($announcement->content ?? '')) }}">


                        <div class="ann-card-meta">
                            <span class="ann-badge
                                @if($announcement->category === 'umum') bg-primary text-white
                                @elseif($announcement->category === 'akademik') bg-info text-dark
                                @elseif($announcement->category === 'beasiswa') bg-success text-white
                                @else bg-warning text-dark
                                @endif">
                                {{ ucfirst($announcement->category) }}
                            </span>
                            <span class="ann-date">
                                <i class="bi bi-calendar3"></i>
                                {{ $announcement->published_at->isoFormat('D MMMM Y') }}
                            </span>
                        </div>

                        <p class="ann-title">{{ $announcement->title }}</p>
                        <p class="ann-excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 160) }}
                        </p>

                        <span class="ann-read-more">
                            Baca Selengkapnya <i class="bi bi-chevron-right"></i>
                        </span>

                    </a>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <h5>Belum ada pengumuman</h5>
                        <p>Pengumuman akan muncul di sini saat tersedia.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($announcements->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $announcements->links() }}
                </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">

            {{-- Info card --}}
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <i class="bi bi-info-circle"></i>
                    <span>Info Penting</span>
                </div>
                <div class="sidebar-card-body">
                    <p>Ikuti terus pengumuman terbaru di portal ini untuk mendapatkan informasi akademik dan kegiatan sekolah secara real-time.</p>
                </div>
            </div>

            {{-- Category stats --}}
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <i class="bi bi-grid-3x3-gap"></i>
                    <span>Kategori</span>
                </div>
                <div class="sidebar-card-body">
                    <ul class="cat-stat-list">
                        <li class="cat-stat-item">
                            <span class="cat-stat-label">
                                <span class="cat-stat-dot" style="background:#0d6efd;"></span>
                                Umum
                            </span>
                            <span class="cat-stat-count">
                                {{ $announcements->where('category','umum')->count() }}
                            </span>
                        </li>
                        <li class="cat-stat-item">
                            <span class="cat-stat-label">
                                <span class="cat-stat-dot" style="background:#0dcaf0;"></span>
                                Akademik
                            </span>
                            <span class="cat-stat-count">
                                {{ $announcements->where('category','akademik')->count() }}
                            </span>
                        </li>
                        <li class="cat-stat-item">
                            <span class="cat-stat-label">
                                <span class="cat-stat-dot" style="background:#198754;"></span>
                                Beasiswa
                            </span>
                            <span class="cat-stat-count">
                                {{ $announcements->where('category','beasiswa')->count() }}
                            </span>
                        </li>
                        <li class="cat-stat-item">
                            <span class="cat-stat-label">
                                <span class="cat-stat-dot" style="background:#ffc107;"></span>
                                Kegiatan
                            </span>
                            <span class="cat-stat-count">
                                {{ $announcements->where('category','kegiatan')->count() }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script>
    function applyAnnouncementSearchAndCategoryFilter() {
        const input = document.getElementById('announcementSearchInput');
        const q = (input && input.value ? input.value : '').trim().toLowerCase();

        const activeChip = document.querySelector('.filter-chip.active');
        const activeCategory = activeChip ? activeChip.getAttribute('onclick') : null;
        // activeCategory extraction fallback (karena tidak ada data-category pada chip)
        // Kita parse dari string onclick: filterByCategory('umum', this)
        let category = 'all';
        if (activeCategory) {
            const m = activeCategory.match(/filterByCategory\('([^']+)'/);
            if (m && m[1]) category = m[1];
        }

        const cards = Array.from(document.querySelectorAll('.ann-card'));
        let visible = 0;

        cards.forEach(card => {
            const title = (card.dataset.title || '');
            const content = (card.dataset.content || '');
            const cardCategory = card.dataset.category || '';

            const matchCategory = (category === 'all' || cardCategory === category);
            const matchSearch = !q || title.includes(q) || content.includes(q);

            const show = matchCategory && matchSearch;
            card.style.display = show ? 'block' : 'none';
            if (show) visible++;
        });

        const emptyMsg = document.getElementById('filter-empty-msg');
        if (emptyMsg) emptyMsg.style.display = visible === 0 ? 'block' : 'none';
    }

    function filterByCategory(category, el) {
        document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
        el.classList.add('active');

        // Lazily create empty state once
        let emptyMsg = document.getElementById('filter-empty-msg');
        if (!emptyMsg) {
            emptyMsg = document.createElement('div');
            emptyMsg.id = 'filter-empty-msg';
            emptyMsg.className = 'text-center py-5 text-muted';
            emptyMsg.innerHTML = '<i class="bi bi-inbox fs-1 d-block mb-2"></i>Tidak ada pengumuman yang cocok.';
            document.getElementById('ann-list').appendChild(emptyMsg);
        }

        applyAnnouncementSearchAndCategoryFilter();
    }

    (function () {
        const input = document.getElementById('announcementSearchInput');
        if (!input) return;
        input.addEventListener('input', applyAnnouncementSearchAndCategoryFilter);
    })();
</script>
@endpush