@extends('layouts.public')

@section('title', $announcement->title . ' - SMA Negeri 5 Morotai')

@push('styles')
<style>
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
    }

    /* ── Detail Hero (Sama kayak page-hero di index) ── */
    .detail-hero {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        padding: 60px 60px 120px; /* Padding bawah lebih besar buat ruang overlap */
        position: relative;
        overflow: hidden;
        color: white;
    }

    .detail-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 240px; height: 240px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .detail-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(74,144,226,0.10);
    }

    .detail-eyebrow {
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

    .detail-hero h1 {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .detail-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 0.9rem;
        color: rgba(232,240,254,0.85);
        position: relative;
        z-index: 1;
        flex-wrap: wrap;
    }

    .detail-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ── Content Card (Overlap Effect) ── */
    .detail-content-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        margin-top: -80px; /* Efek overlap ke atas */
        box-shadow: 0 15px 40px rgba(26,58,107,0.08);
        position: relative;
        z-index: 2;
        border: 1px solid rgba(26,58,107,0.05);
    }

    /* ── Typography untuk Isi Pengumuman ── */
    .announcement-body {
        font-size: 1.05rem;
        line-height: 1.85;
        color: #374151;
    }
    
    .announcement-body p { margin-bottom: 1.5rem; }
    .announcement-body h2, .announcement-body h3 { 
        color: var(--blue-dark); 
        font-weight: 700; 
        margin-top: 2rem; 
        margin-bottom: 1rem; 
    }
    .announcement-body ul, .announcement-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; }
    .announcement-body li { margin-bottom: 0.5rem; }
    
    /* Pastikan gambar di dalam konten responsive & rapi */
    .announcement-body img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 24px 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    /* ── Sidebar Info Card ── */
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
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-info-header i { color: var(--blue-acc); font-size: 1.1rem; }
    .sidebar-info-header span { font-family: 'Poppins', sans-serif; font-size: 0.9rem; font-weight: 700; color: #ffffff; }

    .sidebar-info-body { padding: 24px 20px; }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(26,58,107,0.06);
        font-size: 0.9rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #6b7280; font-weight: 500; }
    .info-value { color: var(--blue-dark); font-weight: 700; text-align: right; }

    .btn-back {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: var(--blue-dark);
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 12px;
        text-decoration: none;
        margin-top: 20px;
        transition: all 0.2s ease;
    }
    .btn-back:hover { background: var(--blue-mid); color: white; transform: translateY(-2px); }

    /* ── Mobile Responsive ── */
    @media (max-width: 767px) {
        .detail-hero { padding: 60px 0 80px; }
        .detail-content-card { 
            margin-top: -40px; 
            padding: 24px 20px; 
            border-radius: 16px 16px 0 0; /* Nyatu dengan bawah di mobile */
        }
        .sidebar-info-card { position: static; margin-top: 30px; }
    }
</style>
@endpush

@section('hero')
    {{-- Hero Section dipisah biar rapi --}}
    <div class="detail-hero">
        
            <div class="detail-eyebrow">
                <i class="bi bi-megaphone"></i>
                {{ ucfirst($announcement->category) }}
            </div>
            <h1>{{ $announcement->title }}</h1>
            <div class="detail-meta">
                <div class="detail-meta-item">
                    <i class="bi bi-calendar3"></i>
                    {{ $announcement->published_at->isoFormat('D MMMM Y') }}
                </div>
                <div class="detail-meta-item">
                    <i class="bi bi-person"></i>
                    {{ $announcement->user->name ?? 'Admin' }}
                </div>
                <div class="detail-meta-item">
                    <span class="badge" style="background: rgba(255,255,255,0.2); color: white; font-weight: 600;">
                        {{ ucfirst($announcement->status) }}
                    </span>
                </div>
            </div>
        
    </div>
@endsection

@section('content')
    <div style="margin-bottom: 80px;">
        <div class="row g-4">
            
            {{-- Kolom Konten Utama --}}
            <div class="col-lg-8">
                <div class="detail-content-card">
                    {{-- PENTING: Gunakan {!! $announcement->content !!} tanpa e() atau nl2br --}}
                    <div class="announcement-body">
                        {!! $announcement->content !!}
                    </div>
                </div>
            </div>

            {{-- Kolom Sidebar Info --}}
            <div class="col-lg-4">
                <div class="sidebar-info-card">
                    <div class="sidebar-info-header">
                        <i class="bi bi-info-circle"></i>
                        <span>Detail Pengumuman</span>
                    </div>
                    <div class="sidebar-info-body">
                        <div class="info-row">
                            <span class="info-label">Dibuat Oleh</span>
                            <span class="info-value">{{ $announcement->user->name ?? 'Admin' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Kategori</span>
                            <span class="info-value">{{ ucfirst($announcement->category) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tanggal Rilis</span>
                            <span class="info-value">{{ $announcement->published_at->isoFormat('D MMM Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value" style="color: {{ $announcement->status === 'published' ? '#198754' : '#ffc107' }}">
                                {{ ucfirst($announcement->status) }}
                            </span>
                        </div>

                        <a href="{{ route('announcements.index') }}" class="btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection