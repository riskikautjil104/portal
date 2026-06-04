@props(['teachers' => collect()])

@push('styles')
    <style>
        .teacher-marquee {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: 0 6px 20px rgba(0,0,0,0.02);
        }

        .teacher-marquee-track {
            display: flex;
            width: max-content;
            animation: teacher-marquee 20s linear infinite;
        }

        .teacher-marquee:hover .teacher-marquee-track {
            animation-play-state: paused;
        }

        @keyframes teacher-marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .teacher-marquee-card {
            width: 260px;
            flex: 0 0 auto;
            padding: 18px 16px;
            margin: 14px;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.04);
            transition: transform 0.2s ease;
        }

        .teacher-marquee-card:hover {
            transform: translateY(-4px);
        }

        .teacher-marquee-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e8f0fe;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .teacher-marquee-avatar-fallback {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #e8f0fe;
            color: #1A3A6B;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            border: 3px solid #e8f0fe;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .teacher-marquee-name {
            font-weight: 800;
            color: #212529;
            margin-top: 12px;
            margin-bottom: 4px;
            font-size: 1rem;
        }

        .teacher-marquee-meta {
            color: #4A90E2;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 6px;
            min-height: 22px;
        }

        .teacher-marquee-sub {
            color: #868e96;
            font-size: 0.78rem;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            background: #f8f9fa;
            padding: 3px 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .teacher-marquee-row {
            display: flex;
            align-items: stretch;
        }

        @media (max-width: 767.98px) {
            .teacher-marquee-card {
                width: 230px;
                margin: 10px;
            }
        }
    </style>
@endpush

@if($teachers->isNotEmpty())
    @php
        // duplicate list so animation looks continuous
        $duped = $teachers->values()->all();
        $duped = array_merge($duped, $duped);
    @endphp

    <div class="teacher-marquee" aria-label="Daftar Pendidik (bergerak)">
        <div class="teacher-marquee-track">
            @foreach($duped as $teacher)
                <div class="teacher-marquee-card">
                    @if($teacher->photo)
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="teacher-marquee-avatar">
                    @else
                        <div class="teacher-marquee-avatar-fallback">
                            {{ substr($teacher->name, 0, 1) }}
                        </div>
                    @endif

                    <div class="teacher-marquee-name">{{ $teacher->name }}</div>
                    <div class="teacher-marquee-meta">{{ $teacher->subject ?? 'Staf Sekolah' }}</div>

                    @if($teacher->nip)
                        <div class="teacher-marquee-sub">NIP: {{ $teacher->nip }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="text-center p-5 bg-light rounded-4 text-muted">
        Belum ada data pendidik yang dimasukkan.
    </div>
@endif

