@extends('layouts.public')

@section('title', 'Profil Sekolah - SMA Negeri 5 Morotai')

@push('styles')
<style>
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
    }

    /* ── Page Hero (Konsisten dengan halaman lain) ── */
   
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

    /* ── Section Card (Konsisten) ── */
    .section-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: 0 8px 32px rgba(26, 58, 107, 0.06);
        border: 1px solid rgba(26, 58, 107, 0.05);
    }

    .section-title {
        position: relative;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 30px;
        padding-bottom: 12px;
        font-size: 1.4rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 4px;
        background: var(--blue-acc);
        border-radius: 2px;
    }

    /* ── Visi & Misi Cards ── */
    .vision-card {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border-radius: 16px;
        padding: 32px;
        color: white;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .vision-card::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }

    .vision-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .vision-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .vision-text {
        font-size: 1.05rem;
        line-height: 1.7;
        color: rgba(255,255,255,0.95);
        position: relative;
        z-index: 1;
        font-style: italic;
    }

    .mission-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mission-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 14px 0;
        border-bottom: 1px solid rgba(26,58,107,0.06);
    }

    .mission-item:last-child { border-bottom: none; }

    .mission-icon {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: var(--blue-acc);
        color: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .mission-text {
        font-size: 0.95rem;
        color: #374151;
        line-height: 1.6;
    }

    /* ── Sambutan Card ── */
    .sambutan-card {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(26, 58, 107, 0.15);
    }

    .sambutan-card::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .sambutan-avatar {
        width: 120px; height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        border: 4px solid rgba(255,255,255,0.25);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
        font-size: 3rem;
    }

    .sambutan-role {
        font-weight: 700;
        color: white;
        font-size: 1rem;
        margin-bottom: 4px;
        text-align: center;
    }

    .sambutan-school {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.7);
        text-align: center;
        margin-bottom: 24px;
    }

    .sambutan-content {
        font-size: 1rem;
        line-height: 1.85;
        color: rgba(255,255,255,0.95);
    }

    /* ── Struktur Organisasi ── */
    .struktur-wrapper {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        border: 1px solid rgba(26,58,107,0.06);
    }

    .struktur-wrapper img {
        max-width: 100%;
        height: auto;
        max-height: 700px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    /* ── Teacher Grid (Marquee) ── */
    .teacher-marquee-wrapper {
        overflow: hidden;
        position: relative;
        padding: 20px 0;
    }

    /* ── Room/Facility Cards ── */
    .room-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .room-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(26,58,107,0.06);
        box-shadow: 0 4px 16px rgba(26,58,107,0.04);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .room-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(26,58,107,0.10);
        border-color: rgba(74,144,226,0.3);
    }

    .room-image-container {
        width: 100%;
        aspect-ratio: 16/10;
        overflow: hidden;
        background: #f8f9fa;
        position: relative;
    }

    .room-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .room-card:hover .room-image {
        transform: scale(1.08);
    }

    .room-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 3rem;
        background: linear-gradient(135deg, #e8f0fe 0%, #f8f9fa 100%);
    }

    .room-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        backdrop-filter: blur(8px);
    }

    .room-body {
        padding: 20px;
    }

    .room-title {
        font-weight: 700;
        color: var(--blue-dark);
        margin: 0;
        font-size: 1.05rem;
    }

    /* ── Statistics Cards ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border-radius: 16px;
        padding: 28px;
        color: white;
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 120px; height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }

    .stat-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .stat-content {
        position: relative;
        z-index: 1;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.85);
        font-weight: 500;
    }

    /* ── Class Distribution ── */
    .class-distribution {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid rgba(26,58,107,0.06);
    }

    .class-distribution-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 16px;
    }

    .class-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        border: 1.5px solid var(--blue-acc);
        color: var(--blue-dark);
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .class-badge:hover {
        background: var(--blue-dark);
        color: white;
        border-color: var(--blue-dark);
    }

    .class-badge strong {
        color: var(--blue-acc);
    }

    .class-badge:hover strong {
        color: white;
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

    /* ── Mobile Responsive ── */
    @media (max-width: 767px) {
        .section-card { padding: 24px 20px; }
        .vision-card, .sambutan-card { padding: 28px 20px; }
        .room-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: 1fr; }
        .stat-card { padding: 20px; }
    }
</style>
@endpush

@section('hero')
    <div class="page-hero">
            <div class="page-hero-eyebrow">
                <i class="bi bi-info-circle"></i>
                Portal Sekolah
            </div>
            <h1>Profil SMA Negeri 5 Morotai</h1>
            <p>Mengenal lebih dekat visi, misi, pendidik, dan fasilitas sekolah kami.</p>
    </div>
@endsection

@section('content')
    <div  style="margin-bottom: 80px;">

        {{-- Visi & Misi Section --}}
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="vision-card">
                        <div class="vision-icon"><i class="bi bi-bullseye" style="font-size:1.8rem;"></i></div>
                    <h3 class="vision-title">Visi Sekolah</h3>
                    <p class="vision-text">
                        "Menjadi sekolah unggul dalam akademik dan akhlak mulia yang membentuk generasi berkarakter dan kompeten."
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-card h-100">
                    <h3 class="section-title">Misi Sekolah</h3>
                    <ul class="mission-list">
                        <li class="mission-item">
                            <div class="mission-icon"><i class="bi bi-check2-circle"></i></div>
                            <div class="mission-text">Menyelenggarakan pendidikan berstandar nasional dengan fokus pada keunggulan akademik.</div>
                        </li>
                        <li class="mission-item">
                            <div class="mission-icon"><i class="bi bi-check2-circle"></i></div>
                            <div class="mission-text">Mengembangkan karakter dan kepribadian siswa yang beriman dan bertakwa.</div>
                        </li>
                        <li class="mission-item">
                            <div class="mission-icon"><i class="bi bi-check2-circle"></i></div>
                            <div class="mission-text">Mempersiapkan siswa untuk melanjutkan pendidikan ke jenjang yang lebih tinggi.</div>
                        </li>
                        <li class="mission-item">
                            <div class="mission-icon"><i class="bi bi-check2-circle"></i></div>
                            <div class="mission-text">Membina keterampilan dan kompetensi sesuai dengan perkembangan zaman.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Sambutan Kepala Sekolah --}}
        @if($sambutan && $sambutan->value)
            <div class="sambutan-card mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-3 text-center mb-4 mb-lg-0">
                        @if($fotoKepsek && $fotoKepsek->value)
                            <div class="sambutan-avatar p-0" style="overflow:hidden;">
                                <img src="{{ asset('storage/' . $fotoKepsek->value) }}" alt="Foto Kepala Sekolah" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        @else
                            <div class="sambutan-avatar"><i class="bi bi-person-workspace"></i></div>
                        @endif
                        <p class="sambutan-role">Kepala Sekolah</p>
                        <p class="sambutan-school">SMA Negeri 5 Morotai</p>
                    </div>

                    <div class="col-lg-9">
                        <h3 class="section-title" style="color: white; margin-bottom: 20px;">Sambutan Kepala Sekolah</h3>
                        <div class="sambutan-content">
                            {!! $sambutan->value !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Struktur Organisasi --}}
        @if($struktur && $struktur->value)
            <div class="section-card">
                <h3 class="section-title">Struktur Organisasi</h3>
                <div class="struktur-wrapper">
                    <img src="{{ asset('storage/' . $struktur->value) }}" alt="Struktur Organisasi SMAN 5 Morotai">
                </div>
            </div>
        @endif

        {{-- Pendidik & Tenaga Kependidikan --}}
        <div class="section-card">
            <h3 class="section-title">Pendidik & Tenaga Kependidikan</h3>
            @include('components.public.teacher-marquee', ['teachers' => $teachers])
        </div>

        {{-- Fasilitas Sekolah --}}
        <div class="section-card">
            <h3 class="section-title">Fasilitas Sekolah</h3>
            @if($rooms->isNotEmpty())
                <div class="room-grid">
                    @foreach($rooms as $room)
                        <div class="room-card">
                            <div class="room-image-container">
                                @if($room->photo)
                                    <img src="{{ asset('storage/' . $room->photo) }}" alt="{{ $room->name }}" class="room-image">
                                @else
                                    <div class="room-image-placeholder"><i class="bi bi-building" style="font-size:3rem;"></i></div>
                                @endif
                                
                                <span class="room-badge 
                                    @if($room->type === 'class') bg-primary text-white
                                    @elseif($room->type === 'lab') bg-info text-dark
                                    @else bg-success text-white
                                    @endif">
                                    @if($room->type === 'class') Kelas
                                    @elseif($room->type === 'lab') Laboratorium
                                    @else Fasilitas
                                    @endif
                                </span>
                            </div>
                            <div class="room-body">
                                <h5 class="room-title">{{ $room->name }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="bi bi-building" style="font-size:1.8rem;"></i></div>
                    <h5 style="font-weight: 700; color: #1a202c; margin-bottom: 8px;">Belum ada data fasilitas</h5>
                    <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">
                        Data fasilitas sekolah akan muncul di sini saat tersedia.
                    </p>
                </div>
            @endif
        </div>

        {{-- Statistik Siswa --}}
        <div class="section-card">
            <h3 class="section-title">Informasi Peserta Didik</h3>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-people"></i></div>
                    <div class="stat-content">
                        <div class="stat-number">{{ number_format($studentsCount) }}</div>
                        <div class="stat-label">Total Peserta Didik</div>
                    </div>
                </div>
                <div class="stat-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="stat-icon"><i class="bi bi-building"></i></div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $classes->count() }}</div>
                        <div class="stat-label">Total Rombongan Belajar</div>
                    </div>
                </div>
            </div>

            @if($classes->isNotEmpty())
                <div class="class-distribution">
                    <h6 class="class-distribution-title">Sebaran Rombongan Belajar (Kelas):</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($classes as $c)
                            <span class="class-badge">
                                {{ $c->class_name }}: <strong>{{ $c->count }} Siswa</strong>
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection