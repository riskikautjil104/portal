@extends('layouts.public')

@section('title', $news->title . ' - SMA Negeri 5 Morotai')

@push('styles')
<style>
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
    }

    /* ── Detail Hero (Sama persis dengan Detail Pengumuman) ── */
    .detail-hero {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        padding: 80px 60px 120px;
        position: relative;
        overflow: hidden;
        color: white;
    }

    .detail-hero::before {
        content: ''; position: absolute; top: -60px; right: -60px;
        width: 240px; height: 240px; border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .detail-hero::after {
        content: ''; position: absolute; bottom: -80px; left: -40px;
        width: 200px; height: 200px; border-radius: 50%;
        background: rgba(74,144,226,0.10);
    }

    .detail-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: 2px;
        text-transform: uppercase; color: var(--blue-acc);
        background: rgba(74,144,226,0.15); border: 1px solid rgba(74,144,226,0.35);
        padding: 4px 14px; border-radius: 30px; margin-bottom: 16px;
        position: relative; z-index: 1;
    }

    .detail-hero h1 {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800; line-height: 1.3; margin-bottom: 16px;
        position: relative; z-index: 1;
    }

    .detail-meta {
        display: flex; align-items: center; gap: 16px;
        font-size: 0.9rem; color: rgba(232,240,254,0.85);
        position: relative; z-index: 1; flex-wrap: wrap;
    }

    .detail-meta-item { display: flex; align-items: center; gap: 6px; }

    /* ── Content Card (Overlap Effect) ── */
    .detail-content-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        margin-top: -80px; /* Efek overlap dramatis ke atas */
        box-shadow: 0 15px 40px rgba(26,58,107,0.08);
        position: relative; z-index: 2;
        border: 1px solid rgba(26,58,107,0.05);
    }

    /* ── Featured Image Styling ── */
    .featured-image-wrap {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 32px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        background: #f8f9fa;
    }
    
    .featured-image-wrap img {
        width: 100%;
        height: auto;
        max-height: 450px;
        object-fit: cover;
        display: block;
    }

    /* ── Typography untuk Isi Berita ── */
    .news-body {
        font-size: 1.05rem;
        line-height: 1.85;
        color: #374151;
    }
    .news-body p { margin-bottom: 1.5rem; }
    .news-body h2, .news-body h3 { 
        color: var(--blue-dark); font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; 
    }
    .news-body ul, .news-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; }
    .news-body li { margin-bottom: 0.5rem; }
    .news-body img {
        max-width: 100%; height: auto; border-radius: 12px;
        margin: 24px 0; box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .news-body a { color: var(--blue-acc); text-decoration: underline; }
    .news-body a:hover { color: var(--blue-dark); }

    /* ── Sidebar Info Card (Sticky) ── */
    .sidebar-info-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(26,58,107,0.06);
        box-shadow: 0 4px 16px rgba(26,58,107,0.04);
        overflow: hidden;
        position: sticky;
        top: 100px; /* Sticky saat di-scroll di desktop */
    }

    .sidebar-info-header {
        background: linear-gradient(135deg, var(--blue-dark), var(--blue-mid));
        padding: 16px 20px;
        display: flex; align-items: center; gap: 10px;
    }

    .sidebar-info-header i { color: var(--blue-acc); font-size: 1.1rem; }
    .sidebar-info-header span { font-family: 'Poppins', sans-serif; font-size: 0.9rem; font-weight: 700; color: #ffffff; }

    .sidebar-info-body { padding: 24px 20px; }

    .info-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 0; border-bottom: 1px solid rgba(26,58,107,0.06);
        font-size: 0.9rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #6b7280; font-weight: 500; }
    .info-value { color: var(--blue-dark); font-weight: 700; text-align: right; }

    .btn-back {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; background: var(--blue-dark); color: white;
        font-weight: 600; padding: 12px; border-radius: 12px;
        text-decoration: none; margin-top: 20px; transition: all 0.2s ease;
    }
    .btn-back:hover { background: var(--blue-mid); color: white; transform: translateY(-2px); }

    /* ── Mobile Responsive ── */
    @media (max-width: 767px) {
        .detail-hero { padding: 60px 0 80px; }
        .detail-content-card { 
            margin-top: -40px; padding: 24px 20px; 
            border-radius: 16px 16px 0 0;
        }
        .sidebar-info-card { position: static; margin-top: 30px; }
        .featured-image-wrap { margin-bottom: 24px; }
    }
</style>
@endpush

{{-- Hero Section dipisah biar rapi --}}
@section('hero')
    <div class="detail-hero">
       
            <div class="detail-eyebrow">
                <i class="bi bi-newspaper"></i>
                {{ $news->category ?? 'Berita Sekolah' }}
            </div>
            <h1>{{ $news->title }}</h1>
            <div class="detail-meta">
                <div class="detail-meta-item">
                    <i class="bi bi-calendar3"></i>
                    {{ $news->created_at->isoFormat('D MMMM Y') }}
                </div>
                <div class="detail-meta-item">
                    <i class="bi bi-person"></i>
                    {{ $news->user->name ?? 'Admin' }}
                </div>
                <div class="detail-meta-item">
                    <span class="badge" style="background: rgba(255,255,255,0.2); color: white; font-weight: 600;">
                        {{ ucfirst($news->status ?? 'Published') }}
                    </span>
                </div>
            </div>
       
    </div>
@endsection

@section('content')
    <div  style="margin-bottom: 80px;">
        <div class="row g-4">
            
            {{-- Kolom Konten Utama --}}
            <div class="col-lg-8">
                <div class="detail-content-card">
                    
                    {{-- Featured Image (Jika Ada) --}}
                    @if(!empty($news->image))
                        <div class="featured-image-wrap">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                        </div>
                    @endif

                    {{-- Isi Berita --}}
                    <div class="news-body">
                        {!! $news->content !!}
                    </div>

                </div>
            </div>

            {{-- Kolom Sidebar Info --}}
            <div class="col-lg-4">
                <div class="sidebar-info-card">
                    <div class="sidebar-info-header">
                        <i class="bi bi-info-circle"></i>
                        <span>Detail Berita</span>
                    </div>
                    <div class="sidebar-info-body">
                        <div class="info-row">
                            <span class="info-label">Penulis</span>
                            <span class="info-value">{{ $news->user->name ?? 'Admin' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Kategori</span>
                            <span class="info-value">{{ $news->category ?? 'Umum' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tanggal Terbit</span>
                            <span class="info-value">{{ $news->created_at->isoFormat('D MMM Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value" style="color: {{ ($news->status ?? 'published') === 'published' ? '#198754' : '#ffc107' }}">
                                {{ ucfirst($news->status ?? 'Published') }}
                            </span>
                        </div>

                        <a href="{{ route('news.index') }}" class="btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection