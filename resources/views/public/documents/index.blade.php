@extends('layouts.public')

@section('title', 'Dokumen - SMA Negeri 5 Morotai')

@push('styles')
    <style>
        :root {
            --blue-dark: #1A3A6B;
            --blue-mid: #2A5298;
            --blue-acc: #4A90E2;
        }

        /* .page-hero {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
            color: #fff;
        } */

        .page-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05)
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(74, 144, 226, .10)
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
            background: rgba(74, 144, 226, .15);
            border: 1px solid rgba(74, 144, 226, .35);
            padding: 4px 14px;
            border-radius: 30px;
            margin-bottom: 16px;
            position: relative;
            z-index: 1
        }

        .page-hero h1 {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            margin: 0 0 10px;
            position: relative;
            z-index: 1
        }

        .page-hero p {
            font-size: .95rem;
            color: rgba(232, 240, 254, .75);
            margin: 0;
            position: relative;
            z-index: 1;
            max-width: 600px
        }

        .docs-card {
            background: #fff;
            border: 1px solid rgba(26, 58, 107, .06);
            border-radius: 18px;
            box-shadow: 0 2px 10px rgba(26, 58, 107, .03);
            padding: 18px 18px;
        }

        .doc-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            flex-wrap: wrap
        }

        .doc-title {
            font-weight: 800;
            color: #1a202c;
            font-size: 1.05rem;
            margin-bottom: 6px
        }

        .doc-desc {
            color: #6b7280;
            line-height: 1.7;
            margin: 0 0 10px
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: .78rem;
            font-weight: 700
        }

        .badge-need {
            background: rgba(74, 144, 226, .12);
            border: 1px solid rgba(74, 144, 226, .25);
            color: var(--blue-dark)
        }

        .badge-free {
            background: rgba(25, 135, 84, .12);
            border: 1px solid rgba(25, 135, 84, .25);
            color: #198754
        }

        .btn-doc {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 800;
            padding: 10px 14px;
            border-radius: 12px;
            background: var(--blue-dark);
            color: #fff;
            border: 0;
        }

        .btn-doc:hover {
            background: var(--blue-mid);
            color: #fff;
        }

        .doc-meta {
            font-size: .82rem;
            color: #9ca3af;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center
        }

        .pagination .page-link {
            border-radius: 10px !important;
            margin: 0 3px;
            border: 1.5px solid rgba(26, 58, 107, .12);
            color: var(--blue-dark);
            font-weight: 700;
            font-size: .875rem;
            padding: 7px 14px
        }

        .pagination .page-item.active .page-link,
        .pagination .page-link:hover {
            background: var(--blue-dark);
            border-color: var(--blue-dark);
            color: #fff
        }

        .empty-state {
            border: 1px solid rgba(26, 58, 107, .06);
            background: #fff;
            border-radius: 16px;
            padding: 60px 24px;
            text-align: center
        }

        .empty-state .icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            background: #EEF3FC;
            color: var(--blue-acc);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 18px
        }

        .empty-state h5 {
            font-weight: 800;
            color: #1a202c;
            margin: 0 0 8px
        }

        .empty-state p {
            color: #9ca3af;
            margin: 0;
            font-size: .875rem
        }
    </style>
@endpush

@section('hero')
    <div class="page-hero">
        <div class="page-hero-eyebrow"><i class="bi bi-file-earmark-text"></i> Portal Dokumen</div>
        <h1>Unduh Dokumen</h1>
        <p>Pilih dokumen yang tersedia. Jika dokumen membutuhkan validasi, Anda akan diminta mengisi data terlebih dahulu.
        </p>
    </div>
@endsection

@section('content')
    <div style="margin-bottom:80px; position:relative; z-index:1;">

        @push('scripts')
        <script type="text/javascript">
            // NOTE: search input & filter are handled client-side.

            (function () {
                const input = document.getElementById('docsSearchInput');
                if (!input) return;

                const items = Array.from(document.querySelectorAll('.doc-item'));
                const emptyState = document.createElement('div');
                emptyState.className = 'col-12';
                emptyState.style.display = 'none';
                emptyState.innerHTML = `
                    <div class="empty-state">
                        <div class="icon"><i class="bi bi-search"></i></div>
                        <h5>Tidak ada hasil</h5>
                        <p>Coba kata kunci lain.</p>
                    </div>
                `;

                const containerRow = document.querySelector('.row.g-4');
                if (containerRow) containerRow.appendChild(emptyState);

                input.addEventListener('input', function () {
                    const q = (input.value || '').trim().toLowerCase();
                    let visible = 0;

                    items.forEach(el => {
                        const title = el.dataset.title || '';
                        const content = el.dataset.content || '';
                        const match = !q || title.includes(q) || content.includes(q);
                        el.style.display = match ? '' : 'none';
                        if (match) visible++;
                    });

                    emptyState.style.display = visible === 0 ? '' : 'none';
                });
            })();
        </script>
        @endpush



        @if ($documents->isEmpty())
            <div class="empty-state">
                <div class="icon"><i class="bi bi-file-earmark-text"></i></div>
                <h5>Belum ada dokumen</h5>
                <p>Dokumen akan muncul di sini saat tersedia.</p>
            </div>
@else
            <div class="row g-4">

                <div class="mb-4" style="max-width:820px;">
                    <div class="input-group">
                        <span class="input-group-text" style="background:#fff;border-color:rgba(26,58,107,0.12);color:#1A3A6B;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input id="docsSearchInput" type="text" class="form-control"
                               placeholder="Cari dokumen... (judul/isi deskripsi)" autocomplete="off">
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-column gap-3">
                        @foreach ($documents as $doc)
                            <div class="docs-card doc-item"
                                 data-title="{{ strtolower($doc->title ?? '') }}"
                                 data-content="{{ strtolower(strip_tags($doc->description ?? '')) }}">
                                <div class="doc-row">
                                    <div style="min-width:260px;flex:1;">
                                        <div class="doc-meta mb-2">
                                            <span><i class="bi bi-clock-history"></i>
                                                {{ $doc->created_at?->format('d M Y') }}</span>
                                            @if ($doc->requires_validation)
                                                <span class="badge-soft badge-need"><i class="bi bi-shield-check"></i> Perlu
                                                    Validasi</span>
                                            @else
                                                <span class="badge-soft badge-free"><i class="bi bi-download"></i> Langsung
                                                    Unduh</span>
                                            @endif
                                        </div>
                                        <div class="doc-title">{{ $doc->title }}</div>
                                        @if (!empty($doc->description))
                                            <p class="doc-desc">{{ \Illuminate\Support\Str::limit($doc->description, 160) }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-start gap-2">
                                        @if ($doc->requires_validation)
                                            <a class="btn-doc"
                                                href="{{ route('documents.request', ['document' => $doc->id]) }}">
                                                <i class="bi bi-pencil-square"></i> Minta Validasi
                                            </a>
                                        @else
                                            <form method="POST"
                                                action="{{ route('documents.download', ['document' => $doc->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn-doc">
                                                    <i class="bi bi-download"></i> Unduh
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
