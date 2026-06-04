@extends('layouts.public')

@section('title', 'Validasi Dokumen - SMA Negeri 5 Morotai')

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

        .glass {
            background: #fff;
            border: 1px solid rgba(26, 58, 107, .06);
            border-radius: 18px;
            box-shadow: 0 2px 10px rgba(26, 58, 107, .03);
            padding: 22px 20px
        }

        .form-label {
            font-weight: 800;
            color: #1a202c;
            font-size: .9rem
        }

        .form-control,
        textarea.form-control {
            border-radius: 12px;
            border: 1.5px solid rgba(26, 58, 107, .12);
            background: #f8f9fa
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(74, 144, 226, .12);
            border-color: var(--blue-acc);
            background: #fff
        }

        .btn-submit {
            border: 0;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 900;
            background: var(--blue-dark);
            color: #fff;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px
        }

        .btn-submit:hover {
            background: var(--blue-mid);
            color: #fff
        }

        .alert-custom {
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 12px
        }

        .alert-danger-custom {
            background: #fee;
            border: 1px solid #fcc;
            color: #c33
        }

        .alert-success-custom {
            background: #efe;
            border: 1px solid #cfc;
            color: #3c3
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: .78rem;
            font-weight: 800
        }

        .badge-need {
            background: rgba(74, 144, 226, .12);
            border: 1px solid rgba(74, 144, 226, .25);
            color: var(--blue-dark)
        }
    </style>
@endpush

@section('hero')
    <div class="page-hero">
       
            <div class="page-hero-eyebrow"><i class="bi bi-shield-check"></i> Validasi Dokumen</div>
            <h1>{{ $doc->title }}</h1>
            <p>Isi data berikut untuk melanjutkan unduhan dokumen.</p>
        
    </div>
@endsection

@section('content')
    <div  style="margin-bottom:80px; position:relative; z-index:1;">

        @if ($errors->any())
            <div class="alert-custom alert-danger-custom">
                <i class="bi bi-exclamation-triangle" style="font-size:1.3rem;line-height:1"></i>
                <div>
                    <div class="fw-bold mb-2">Periksa input Anda:</div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="glass">
            <form method="POST" action="{{ route('documents.download', ['document' => $doc->id]) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="full_name">Nama Lengkap</label>
                        <input id="full_name" name="full_name" type="text"
                            class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}"
                            required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" name="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="phone">No. HP (opsional)</label>
                        <input id="phone" name="phone" type="text"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="institution">Instansi/Sekolah (opsional)</label>
                        <input id="institution" name="institution" type="text"
                            class="form-control @error('institution') is-invalid @enderror"
                            value="{{ old('institution') }}">
                        @error('institution')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="position">Jabatan/Peran (opsional)</label>
                        <input id="position" name="position" type="text"
                            class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}">
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @php
                    $fields = $doc->validation_fields_json ?? [];
                @endphp

                @if (is_array($fields) && count($fields) > 0)
                    <hr class="my-4" />
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="badge-soft badge-need"><i class="bi bi-sliders"></i> Field Tambahan</span>
                    </div>

                    <div class="row g-3">
                        @foreach ($fields as $f)
                            @php
                                $name = is_array($f) ? $f['name'] ?? '' : '';
                                $required = is_array($f) ? $f['required'] ?? false : false;
                                if (!$name) {
                                    continue;
                                }
                            @endphp
                            <div class="col-md-6">
                                <label class="form-label" for="field_{{ $name }}">
                                    {{ $f['label'] ?? ucfirst($name) }}
                                    @if ($required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>

                                <input id="field_{{ $name }}" name="{{ $name }}" type="text"
                                    class="form-control @error($name) is-invalid @enderror" value="{{ old($name) }}"
                                    {{ $required ? 'required' : '' }}>
                                @error($name)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-download"></i> Unduh Dokumen Setelah Validasi
                    </button>
                    <div class="text-muted" style="font-size:.85rem;margin-top:10px;line-height:1.6">
                        Dengan mengunduh, Anda setuju data validasi yang Anda isi digunakan untuk pencatatan unduhan.
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
