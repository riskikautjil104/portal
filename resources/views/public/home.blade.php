@extends('layouts.public')

@section('title', 'Beranda - SMA Negeri 5 Morotai')

@push('styles')
<style>
    /* ── Base ──────────────────────────────────────── */
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
        --bg-page:   #F0F4FA;
    }

    /* body {
        background: var(--bg-page) !important;
    } */
     body {
    background: #EEF3FA !important;
}


    /* ── Hero Carousel ─────────────────────────────── */
       /* ── Hero Carousel ─────────────────────────────── */
    .hero-wrap {
        border-radius: 0;
        margin-bottom: 0;
        box-shadow: none;
        overflow: hidden;
        position: relative;
    }

    /* 1. PERBAIKAN RESPONSIVE: Tinggi hero di HP jangan 560px (kegedean) */
    .carousel-item {
        height: 65vh; /* Di HP pakai 65% tinggi layar */
        min-height: 400px;
    }

    @media (min-width: 768px) {
        .carousel-item {
            height: 560px; /* Di laptop tetap 560px sesuai desain lo */
        }
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.65; /* Sedikit dinaikkan biar gambar lebih jelas tapi teks tetap aman */
        transition: transform 7s ease-in-out;
    }

    .carousel-item.active img { 
        transform: scale(1.06); 
    }

    .carousel-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to right,
            rgba(8, 20, 48, 0.85) 0%,
            rgba(26, 58, 107, 0.55) 45%,
            rgba(26, 58, 107, 0.15) 100%
        );
        z-index: 1;
    }

    /* 2. PERBAIKAN TRANSISI: Pastikan fade bawah nyambung sama background biru muda */
    .carousel-overlay::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 120px; /* Dibuat agak lebih panjang biar gradasinya lebih halus */
        /* Ganti #EEF3FA ini sesuai warna biru muda background lo */
        background: linear-gradient(to top, #BBDEFB 0%, transparent 100%);
        z-index: 2;
    }

    .carousel-caption {
        z-index: 3;
        bottom: 90px;
        text-align: left;
        left: max(24px, calc((100% - 1320px) / 2 + 24px));
        right: max(24px, calc((100% - 1320px) / 2 + 24px));
    }

    .caption-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #4A90E2;
        background: rgba(74, 144, 226, 0.15);
        border: 1px solid rgba(74, 144, 226, 0.40);
        padding: 5px 16px;
        border-radius: 30px;
        margin-bottom: 18px;
        backdrop-filter: blur(4px); /* Tambahan biar makin modern */
    }

    .caption-eyebrow::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #4A90E2;
        animation: pulse-dot 1.8s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.4; transform: scale(0.6); }
    }

    .carousel-caption h1 {
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        font-weight: 800;
        color: #ffffff !important;
        line-height: 1.15;
        margin-bottom: 16px;
        text-shadow: 0 3px 24px rgba(0,0,0,0.6);
    }

    .carousel-caption p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.90) !important;
        max-width: 580px;
        line-height: 1.65;
        text-shadow: 0 2px 12px rgba(0,0,0,0.5);
    }

    /* ── Default Hero ──────────────────────────────── */
    .default-hero {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border-radius: 22px;
        padding: 96px 48px;
        text-align: center;
        margin-bottom: 56px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(26, 58, 107, 0.20);
    }

    .default-hero::before,
    .default-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .default-hero::before { width: 340px; height: 340px; top: -100px; right: -80px; }
    .default-hero::after  { width: 220px; height: 220px; bottom: -70px; left: -50px; }

    .default-hero h1 {
        font-size: clamp(1.9rem, 3.5vw, 2.8rem);
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .default-hero p {
        font-size: 1.1rem;
        color: rgba(232, 240, 254, 0.80);
        max-width: 540px;
        margin: 0 auto 32px;
        position: relative;
        z-index: 1;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        color: var(--blue-dark);
        font-weight: 700;
        font-size: 0.95rem;
        padding: 13px 30px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
        z-index: 1;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }

    .hero-btn:hover {
        background: #e8f0fe;
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.20);
    }

    /* ── Section Label ─────────────────────────────── */
    .section-label {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
    }

    .section-label h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin: 0;
    }

    .section-label-bar {
        width: 36px;
        height: 4px;
        background: var(--blue-acc);
        border-radius: 2px;
        flex-shrink: 0;
    }

    /* ── Sambutan ──────────────────────────────────── */
    .sambutan-wrap {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(26, 58, 107, 0.15);
        overflow: hidden;
        margin-bottom: 56px;
        position: relative;
    }

    .sambutan-wrap::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .sambutan-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        border: 3px solid rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }

    .sambutan-avatar i {
        font-size: 2.8rem;
        color: rgba(255,255,255,0.90);
    }

    .sambutan-role {
        font-weight: 700;
        color: #ffffff;
        font-size: 0.95rem;
        margin-bottom: 4px;
    }

    .sambutan-school {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.55);
    }

    .sambutan-divider {
        width: 1px;
        background: rgba(255,255,255,0.15);
        align-self: stretch;
    }

    .sambutan-content h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 14px;
    }

    .sambutan-text {
        color: rgba(232, 240, 254, 0.85);
        line-height: 1.85;
        font-size: 0.97rem;
    }

    /* ── Stats Bar ─────────────────────────────────── */
    .stats-bar {
        background: #ffffff;
        border-radius: 18px;
        padding: 28px 32px;
        margin-bottom: 56px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 0;
        box-shadow: 0 4px 20px rgba(26, 58, 107, 0.06);
        border: 1px solid rgba(26, 58, 107, 0.06);
    }

    .stat-item {
        text-align: center;
        padding: 12px 16px;
        position: relative;
    }

    .stat-item + .stat-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 20%;
        height: 60%;
        width: 1px;
        background: rgba(26, 58, 107, 0.10);
    }

    .stat-number {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: var(--blue-dark);
        line-height: 1;
        margin-bottom: 6px;
    }

    .stat-number span {
        color: var(--blue-acc);
    }

    .stat-label {
        font-size: 0.78rem;
        color: #718096;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ── Portal Cards ──────────────────────────────── */
    .portal-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-bottom: 56px;
    }

    .portal-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid rgba(26, 58, 107, 0.07);
        padding: 28px 20px 24px;
        text-align: center;
        transition: all 0.28s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(26, 58, 107, 0.04);
    }

    .portal-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--blue-dark), var(--blue-acc));
        opacity: 0;
        transition: opacity 0.28s ease;
    }

    .portal-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 48px rgba(26, 58, 107, 0.13);
        border-color: rgba(74, 144, 226, 0.25);
    }

    .portal-card:hover::after { opacity: 1; }

    .portal-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #EEF3FC;
        color: var(--blue-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 1.55rem;
        transition: all 0.28s ease;
    }

    .portal-card:hover .portal-icon {
        background: var(--blue-dark);
        color: #ffffff;
        transform: scale(1.10) rotate(-5deg);
    }

    .portal-card h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 8px;
    }

    .portal-card p {
        font-size: 0.84rem;
        color: #718096;
        line-height: 1.55;
        margin-bottom: 18px;
        min-height: 36px;
    }

    .portal-link {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--blue-dark);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s ease, color 0.2s ease;
    }

    .portal-card:hover .portal-link { color: var(--blue-acc); gap: 10px; }

    /* ── Announcement Cards ────────────────────────── */
    .ann-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26, 58, 107, 0.06);
        border-left: 4px solid var(--blue-acc);
        padding: 20px 22px;
        transition: all 0.25s ease;
        box-shadow: 0 2px 10px rgba(26, 58, 107, 0.03);
    }

    .ann-card:hover {
        transform: translateX(4px);
        box-shadow: 0 8px 28px rgba(26, 58, 107, 0.09);
        border-left-color: var(--blue-dark);
    }

    .ann-badge {
        display: inline-block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 4px 12px;
        border-radius: 30px;
    }

    .ann-date {
        font-size: 0.78rem;
        color: #9ca3af;
        font-weight: 500;
    }

    .ann-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1a202c;
        margin: 10px 0 7px;
        line-height: 1.45;
    }

    .ann-excerpt {
        font-size: 0.865rem;
        color: #6b7280;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 14px;
    }

    /* ── News Cards ────────────────────────────────── */
    .news-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26, 58, 107, 0.06);
        padding: 14px;
        transition: all 0.25s ease;
        box-shadow: 0 2px 10px rgba(26, 58, 107, 0.03);
    }

    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(26, 58, 107, 0.09);
    }

    .news-thumb {
        border-radius: 10px;
        overflow: hidden;
        height: 90px;
    }

    .news-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .news-card:hover .news-thumb img { transform: scale(1.08); }

    .news-meta {
        font-size: 0.75rem;
        color: #9ca3af;
        font-weight: 500;
        margin-bottom: 6px;
    }

    .news-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1a202c;
        line-height: 1.45;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 6px;
    }

    .news-excerpt {
        font-size: 0.82rem;
        color: #6b7280;
        line-height: 1.55;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 10px;
    }

    /* ── Shared utils ──────────────────────────────── */
    .section-block { margin-bottom: 60px; }

    .read-link, .see-all-link {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--blue-acc);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: gap 0.2s ease, color 0.2s ease;
    }

    .read-link:hover, .see-all-link:hover { gap: 8px; color: var(--blue-dark); }

    /* ── BG accent strip behind content ───────────── */
    .content-accent-bg {
        background: linear-gradient(180deg, var(--bg-page) 0%, #e8eef8 100%);
        border-radius: 24px;
        padding: 40px;
        margin-bottom: 56px;
    }

    @media (max-width: 767px) {
        .content-accent-bg { padding: 24px 16px; }
        .stats-bar { gap: 8px; }
        .stat-item + .stat-item::before { display: none; }
        
    }
    .portal-card,
.ann-card,
.news-card,
.stats-bar,
.sambutan-wrap {
    backdrop-filter: blur(2px);}
  .carousel-caption {
        z-index: 3;
        bottom: 90px;
        text-align: left;
        
        /* Sejajar dengan container-xl (max 1320px) */
        left: max(24px, calc((100% - 1320px) / 2 + 24px));
        right: max(24px, calc((100% - 1320px) / 2 + 24px));
    }

    .carousel-caption h1 {
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        font-weight: 800;
        color: #ffffff !important;
        line-height: 1.15;
        margin-bottom: 16px;
        text-shadow: 0 3px 24px rgba(0,0,0,0.6);
        opacity: 1 !important;
    }

    .carousel-caption p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.90) !important;
        max-width: 580px;
        line-height: 1.65;
        text-shadow: 0 2px 12px rgba(0,0,0,0.5);
        opacity: 1 !important;
    }

    /* overlay lebih gelap biar teks kebaca */
    .carousel-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to right,
            rgba(8, 20, 48, 0.85) 0%,
            rgba(26, 58, 107, 0.55) 45%,
            rgba(26, 58, 107, 0.15) 100%
        );
        z-index: 1;
    }
</style>
@endpush

{{-- HERO: di luar container, full width --}}
@section('hero')
    @if($banners->isNotEmpty())
        <div class="hero-wrap">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
                <div class="carousel-indicators">
                    @foreach($banners as $index => $banner)
                        <button type="button" data-bs-target="#heroCarousel"
                                data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : '' }}">
                        </button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}">
                            <div class="carousel-overlay"></div>
                            <div class="carousel-caption d-none d-md-block">
                                <div class="caption-eyebrow">SMA Negeri 5 Morotai</div>
                                @if($banner->title)<h1>{{ $banner->title }}</h1>@endif
                                @if($banner->subtitle)<p>{{ $banner->subtitle }}</p>@endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Berikutnya</span>
                </button>
            </div>
        </div>
    @else
        <div class="default-hero">
            <h1>Selamat Datang di Portal SMAN 5 Morotai</h1>
            <p>Pusat Layanan dan Informasi Akademik Terintegrasi Sekolah Menengah Atas Negeri 5 Pulau Morotai.</p>
            <a href="{{ route('announcements.index') }}" class="hero-btn">
                Lihat Pengumuman <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    @endif
@endsection


@section('content')

    {{-- ═══════════════════════════════════════
         HERO
    ═══════════════════════════════════════ --}}
    {{-- @if($banners->isNotEmpty())
        <div class="hero-wrap">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
                <div class="carousel-indicators">
                    @foreach($banners as $index => $banner)
                        <button type="button" data-bs-target="#heroCarousel"
                                data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : '' }}">
                        </button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}">
                            <div class="carousel-overlay"></div>
                            @if($banner->title || $banner->subtitle)
                                <div class="carousel-caption d-none d-md-block">
                                    <span class="caption-eyebrow">SMA Negeri 5 Morotai</span>
                                    @if($banner->title)<h1>{{ $banner->title }}</h1>@endif
                                    @if($banner->subtitle)<p>{{ $banner->subtitle }}</p>@endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Berikutnya</span>
                </button>
            </div>
        </div>
    @else
        <div class="default-hero">
            <h1>Selamat Datang di Portal SMAN 5 Morotai</h1>
            <p>Pusat Layanan dan Informasi Akademik Terintegrasi Sekolah Menengah Atas Negeri 5 Pulau Morotai.</p>
            <a href="{{ route('announcements.index') }}" class="hero-btn">
                Lihat Pengumuman <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    @endif --}}


    {{-- ═══════════════════════════════════════
         SAMBUTAN KEPALA SEKOLAH
    ═══════════════════════════════════════ --}}
    @if($sambutan && $sambutan->value)
     <div class="section-label mt-44" style="padding-top: 100px; font-size :100px;">
                        <div class="section-label-bar"></div>
                        <h3>Sambutan Kepala Sekolah</h3>
                    </div>
        <div class="sambutan-wrap p-4 p-md-5 section-block" >
            <div class="row align-items-center g-4">
                <div class="col-lg-3 text-center">
                    <div class=" overflow-hidden" style="display:flex; align-items:center; justify-content:center;">
                        @if($fotoKepsek && $fotoKepsek->value)
                            <img src="{{ asset('storage/' . $fotoKepsek->value) }}" alt="Foto Kepala Sekolah" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <i class="bi bi-person-circle"></i>
                        @endif
                    </div>
                    <p class="fw-700 mb-1" style="color: #ffffff; font-weight: 700;">Kepala Sekolah</p>
                    <p  style="font-size: 0.85rem; color: #ffffff;">SMA Negeri 5 Morotai</p>
                </div>

                <div class="col-lg-9">
                    {{-- <div class="section-label mb-3" >
                        <div class="section-label-bar"></div>
                        <h3 style="color: #ffffff">Sambutan Kepala Sekolah</h3>
                    </div> --}}
                    <div class="sambutan-text">
                        {!! $sambutan->value !!}
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- ═══════════════════════════════════════
         STATISTIK SISWA AKTIF
    ═══════════════════════════════════════ --}}
    <div class="stats-bar mb-5" style="margin-bottom:56px;">
        <div class="stat-item">
            <div class="stat-number">{{ $studentsActiveCount ?? 0 }}</div>
            <div class="stat-label">Siswa Aktif</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $studentsActiveMaleCount ?? 0 }}<span></span></div>
            <div class="stat-label">Laki-laki</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $studentsActiveFemaleCount ?? 0 }}<span></span></div>
            <div class="stat-label">Perempuan</div>
        </div>
    </div>


    {{-- ═══════════════════════════════════════
         PORTAL SEKOLAH
    ═══════════════════════════════════════ --}}
    <div class="section-block">
        <div class="section-label">
            <div class="section-label-bar"></div>
            <h3>Akses Portal Sekolah</h3>
        </div>

        @if($portalLinks->isNotEmpty())
            <div class="portal-grid">
                @foreach($portalLinks as $link)
                    <div class="portal-card">
                        <div class="portal-icon">
                            <i class="{{ $link->icon ?? 'bi bi-link-45deg' }}"></i>
                        </div>
                        <h5>{{ $link->name }}</h5>
                        <p>{{ $link->description ?? 'Akses portal resmi untuk kebutuhan administrasi & akademik' }}</p>
                        <a href="{{ $link->url }}" target="_blank" class="portal-link">
                            Akses Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-white rounded-4 text-muted border">
                Belum ada portal link yang aktif.
            </div>
        @endif
    </div>


    {{-- ═══════════════════════════════════════
         PENDIDIK & TENAGA KEPENDIDIKAN
    ═══════════════════════════════════════ --}}
    @if(isset($teachers) && $teachers->isNotEmpty())
        <div class="section-block">
            <div class="section-label">
                <div class="section-label-bar"></div>
                <h3>Pendidik &amp; Tenaga Kependidikan</h3>
            </div>
            @include('components.public.teacher-marquee', ['teachers' => $teachers])
        </div>
    @endif


    {{-- ═══════════════════════════════════════
         PENGUMUMAN & BERITA
    ═══════════════════════════════════════ --}}
    <div class="row g-5 section-block">

        {{-- Pengumuman --}}
        <div class="col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="section-label mb-0">
                    <div class="section-label-bar"></div>
                    <h3>Pengumuman Terbaru</h3>
                </div>
                <a href="{{ route('announcements.index') }}" class="see-all-link">
                    Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($announcements as $announcement)
                    <div class="ann-card">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="ann-badge
                                @if($announcement->category === 'umum') bg-primary text-white
                                @elseif($announcement->category === 'akademik') bg-info text-dark
                                @elseif($announcement->category === 'beasiswa') bg-success text-white
                                @else bg-warning text-dark
                                @endif">
                                {{ $announcement->category }}
                            </span>
                            <span class="ann-date">
                                {{ \Carbon\Carbon::parse($announcement->published_at)->isoFormat('D MMM Y') }}
                            </span>
                        </div>
                        <p class="ann-title">{{ $announcement->title }}</p>
                        <p class="ann-excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 120) }}
                        </p>
                        <a href="{{ route('announcements.show', Crypt::encryptString($announcement->id)) }}" class="read-link">
                            Baca Selengkapnya <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-4 bg-white rounded-4 border text-muted">
                        Tidak ada pengumuman terbaru.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Berita --}}
        <div class="col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="section-label mb-0">
                    <div class="section-label-bar"></div>
                    <h3>Berita Terkini</h3>
                </div>
                <a href="{{ route('news.index') }}" class="see-all-link">
                    Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($news as $item)
                    <div class="news-card">
                        <div class="row g-3 align-items-center">
                            @if($item->image)
                                <div class="col-4">
                                    <div class="news-thumb">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                    </div>
                                </div>
                            @endif
                            <div class="col-{{ $item->image ? '8' : '12' }}">
                                <p class="news-meta">
                                    {{ $item->created_at->isoFormat('D MMM Y') }}
                                    &middot; {{ $item->user->name ?? 'Admin' }}
                                </p>
                                <p class="news-title">{{ $item->title }}</p>
                                <p class="news-excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                                </p>
                                <a href="{{ route('news.show', $item->slug) }}" class="read-link">
                                    Baca Berita <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 bg-white rounded-4 border text-muted">
                        Tidak ada berita terbaru.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

@endsection