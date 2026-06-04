@extends('layouts.public')

@section('title', 'Siswa - SMA Negeri 5 Morotai')

@push('styles')
<style>
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
    }

    .page-hero {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
        color: white;
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
        max-width: 600px;
    }

    .card-soft {
        border-radius: 16px;
        border: 1px solid rgba(26,58,107,0.06);
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(26,58,107,0.03);
    }

    .filters {
        padding: 22px;
    }

    .filters label {
        font-weight: 700;
        color: var(--blue-dark);
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: block;
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1.5px solid rgba(26,58,107,0.12);
    }

    .btn-primary {
        border-radius: 12px;
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border: none;
        font-weight: 800;
        padding: 12px 18px;
    }

    .btn-ghost {
        border-radius: 12px;
        border: 1.5px solid rgba(26,58,107,0.12);
        background: #fff;
        color: var(--blue-dark);
        font-weight: 800;
        padding: 12px 18px;
    }

    .student-grid {
        padding: 22px;
    }

    .student-card {
        display: flex;
        gap: 14px;
        align-items: center;
        padding: 16px;
        border-radius: 14px;
        border: 1px solid rgba(26,58,107,0.06);
        background: #fff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .student-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(26,58,107,0.08);
    }

    .student-avatar {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        overflow: hidden;
        background: #EEF3FC;
        border: 1px solid rgba(74,144,226,0.15);
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-dark);
        font-weight: 900;
    }

    .student-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .student-meta {
        flex: 1;
        min-width: 0;
    }

    .student-name {
        font-weight: 900;
        color: var(--blue-dark);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .student-sub {
        font-size: 0.9rem;
        color: #6b7280;
        margin: 0;
    }

    .empty-state {
        text-align: center;
        padding: 60px 24px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px dashed rgba(26,58,107,0.15);
    }

    .empty-state i {
        color: var(--blue-acc);
        font-size: 2rem;
        margin-bottom: 12px;
        display: inline-block;
    }

    .pagination .page-link {
        border-radius: 10px !important;
        margin: 0 3px;
        border: 1.5px solid rgba(26,58,107,0.12);
        color: var(--blue-dark);
        font-weight: 700;
        font-size: 0.875rem;
        padding: 7px 14px;
        transition: all 0.2s ease;
    }

    .pagination .page-item.active .page-link,
    .pagination .page-link:hover {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: #ffffff;
    }
</style>
@endpush

@section('hero')
    <div class="page-hero">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="bi bi-people"></i>
                Portal Sekolah
            </div>
            <h1>Daftar Siswa</h1>
            <p>Filter berdasarkan kelas, cari berdasarkan nama, dan tampilkan siswa aktif.</p>
        </div>
    </div>
@endsection

@section('content')
<div class="container" style="margin-bottom: 80px; position: relative; z-index: 2;">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card-soft filters">
                <form method="GET" action="{{ route('students.index') }}">
                    <div class="mb-3">
                        <label for="q">Cari Nama</label>
                        <input type="text" class="form-control" id="q" name="q" placeholder="Masukkan nama siswa..." value="{{ $q }}">
                    </div>

                    <div class="mb-3">
                        <label for="class">Filter Kelas</label>
                        <select class="form-select" id="class" name="class">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $c)
                                <option value="{{ $c }}" {{ $class === $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="active">Siswa Aktif</label>
                        <select class="form-select" id="active" name="active">
                            <option value="" {{ $active === '' ? 'selected' : '' }}>Semua</option>
                            <option value="1" {{ $active === '1' ? 'selected' : '' }}>Aktif (punya kelas)</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                        <a href="{{ route('students.index') }}" class="btn btn-ghost text-center">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card-soft student-grid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="fw-bold" style="color: var(--blue-dark);">Ringkasan</div>
                        <div class="text-muted" style="font-size: 0.9rem;">Total siswa: {{ $students->total() }}</div>
                    </div>

                    <div class="text-end">
                        <div class="text-muted" style="font-size: 0.9rem;">
                            Total Aktif: <b>{{ $summary['active_count'] ?? 0 }}</b>
                        </div>
                        <div class="text-muted" style="font-size: 0.9rem;">
                            Total Tidak Aktif: <b>{{ $summary['inactive_count'] ?? 0 }}</b>
                        </div>
                    </div>
                </div>


                        <div class="col-6 col-md-3">
                            <div class="card" style="border-radius:12px;border:1px solid rgba(26,58,107,0.06);background:#fff;">
                                <div class="card-body py-3">
                                    <div class="text-muted" style="font-weight:800;">Laki-laki</div>
                                    <div style="font-weight:900;color:var(--blue-dark);font-size:1.4rem;">{{ $students->where('gender','L')->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card" style="border-radius:12px;border:1px solid rgba(26,58,107,0.06);background:#fff;">
                                <div class="card-body py-3">
                                    <div class="text-muted" style="font-weight:800;">Perempuan</div>
                                    <div style="font-weight:900;color:var(--blue-dark);font-size:1.4rem;">{{ $students->where('gender','P')->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card" style="border-radius:12px;border:1px solid rgba(26,58,107,0.06);background:#fff;">
                                <div class="card-body py-3">
                                    <div class="text-muted" style="font-weight:800;">Aktif (L/P)</div>
                                    <div style="font-weight:900;color:var(--blue-dark);font-size:1.4rem;">{{ $students->where('active', true)->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card" style="border-radius:12px;border:1px solid rgba(26,58,107,0.06);background:#fff;">
                                <div class="card-body py-3">
                                    <div class="text-muted" style="font-weight:800;">Tidak Aktif</div>
                                    <div style="font-weight:900;color:var(--blue-dark);font-size:1.4rem;">{{ $students->where('active', false)->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($students->count() === 0)
                    <div class="empty-state">
                        <i class="bi bi-person-x-fill"></i>
                        <h5 style="font-weight: 900; color: var(--blue-dark);">Tidak ada siswa</h5>
                        <p class="text-muted mb-0">Coba ubah filter atau kata kunci pencarian.</p>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach($students as $s)
                            <div class="col-12">
                                <div class="student-card">
                                    <div class="student-avatar">
                                        @if($s->photo)
                                            <img src="{{ asset('storage/' . $s->photo) }}" alt="{{ $s->name }}">
                                        @else
                                            {{ substr($s->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="student-meta">
                                        <div class="student-name">{{ $s->name }}</div>
                                        <p class="student-sub">
                                            @if($s->class_name)
                                                Kelas: <b>{{ $s->class_name }}</b>
                                            @else
                                                Kelas: <span class="text-muted">(belum diisi)</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

