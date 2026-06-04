@extends('layouts.public')

@section('title', 'Kontak - SMA Negeri 5 Morotai')

@push('styles')
<style>
    :root {
        --blue-dark: #1A3A6B;
        --blue-mid:  #2A5298;
        --blue-acc:  #4A90E2;
    }

    /* ── Page Hero (Konsisten) ── */
   
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

    /* ── Contact Info Card ── */
    .contact-info-card {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(26, 58, 107, 0.15);
        height: 100%;
    }

    .contact-info-card::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .contact-info-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .contact-info-subtitle {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.75);
        margin-bottom: 32px;
        position: relative;
        z-index: 1;
    }

    .contact-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        margin-bottom: 24px;
        position: relative;
        z-index: 1;
    }

    .contact-item:last-child { margin-bottom: 0; }

    .contact-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .contact-item:hover .contact-icon {
        background: rgba(255,255,255,0.25);
        transform: scale(1.05);
    }

    .contact-content h6 {
        font-size: 0.85rem;
        font-weight: 700;
        color: rgba(255,255,255,0.7);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .contact-content p {
        font-size: 0.95rem;
        color: white;
        margin: 0;
        line-height: 1.6;
    }

    .contact-content a {
        color: white;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .contact-content a:hover {
        color: var(--blue-acc);
    }

    /* ── Social Media Links ── */
    .social-links {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid rgba(255,255,255,0.15);
        position: relative;
        z-index: 1;
    }

    .social-link {
        width: 40px; height: 40px;
        border-radius: 10px;
        background: rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-link:hover {
        background: rgba(255,255,255,0.25);
        transform: translateY(-3px);
        color: white;
    }

    /* ── Contact Form Card ── */
    .contact-form-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(26, 58, 107, 0.08);
        border: 1px solid rgba(26, 58, 107, 0.05);
        height: 100%;
    }

    .form-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 8px;
    }

    .form-subtitle {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 32px;
    }

    /* ── Modern Form Inputs ── */
    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--blue-dark);
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        font-size: 0.95rem;
        border: 1.5px solid rgba(26, 58, 107, 0.12);
        border-radius: 12px;
        background: #f8f9fa;
        color: #212529;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--blue-acc);
        background: white;
        box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.1);
    }

    .form-control::placeholder {
        color: #9ca3af;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* ── Submit Button ── */
    .btn-submit {
        width: 100%;
        padding: 14px 32px;
        font-size: 0.95rem;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(26, 58, 107, 0.2);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(26, 58, 107, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* ── Alert Messages ── */
    .alert-custom {
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .alert-custom i {
        font-size: 1.2rem;
    }

    .alert-danger-custom {
        background: #fee;
        border: 1px solid #fcc;
        color: #c33;
    }

    .alert-success-custom {
        background: #efe;
        border: 1px solid #cfc;
        color: #3c3;
    }

    /* ── Google Maps Embed ── */
    .map-embed-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(26, 58, 107, 0.08);
        border: 1px solid rgba(26, 58, 107, 0.05);
    }

    .map-embed-header {
        background: linear-gradient(135deg, var(--blue-dark), var(--blue-mid));
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
    }

    .map-embed-header i {
        font-size: 1.3rem;
        color: var(--blue-acc);
    }

    .map-embed-header h5 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
    }

    .map-embed-body {
        position: relative;
        padding-bottom: 40%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
    }

    .map-embed-body iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* ── Mobile Responsive ── */
    @media (max-width: 767px) {
        .contact-info-card, .contact-form-card { padding: 28px 20px; }
        .contact-item { gap: 12px; }
        .contact-icon { width: 42px; height: 42px; font-size: 1.1rem; }
    }
</style>
@endpush

@section('hero')
    <div class="page-hero">
            <div class="page-hero-eyebrow">
                <i class="bi bi-envelope"></i>
                Portal Sekolah
            </div>
            <h1>Hubungi Kami</h1>
            <p>Ada pertanyaan atau ingin berkolaborasi? Kami siap membantu Anda.</p>
    </div>
@endsection

@section('content')
    <div  style="margin-bottom: 80px;">

        {{-- Alert Messages --}}
        @if ($errors->any())
            <div class="alert-custom alert-danger-custom">
                <i class="bi bi-exclamation-circle"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert-custom alert-success-custom">
                <i class="bi bi-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        {{-- Contact Info & Form --}}
        <div class="row g-4 mb-5">
            
            {{-- Contact Information --}}
            <div class="col-lg-5">
                <div class="contact-info-card">
                    <h3 class="contact-info-title">Informasi Kontak</h3>
                    <p class="contact-info-subtitle">Kami siap membantu Anda</p>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="contact-content">
                            <h6>Email</h6>
                            <p><a href="mailto:info@sman5morotai.sch.id">info@sman5morotai.sch.id</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="contact-content">
                            <h6>Telepon</h6>
                            <p><a href="tel:+62927321456">(0927) 321-456</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="contact-content">
                            <h6>Alamat</h6>
                            <p>Kabupaten Pulau Morotai<br>Provinsi Maluku Utara</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="contact-content">
                            <h6>Jam Kerja</h6>
                            <p>Senin - Jumat: 07:00 - 16:00<br>Sabtu - Minggu: Tutup</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-link" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-link" title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                        <a href="#" class="social-link" title="Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h3 class="form-title">Kirim Pesan</h3>
                    <p class="form-subtitle">Isi form di bawah ini dan kami akan segera menghubungi Anda</p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Masukkan nama lengkap Anda" 
                                   value="{{ old('name') }}"
                                   required>
                            @error('name') 
                                <div style="color: #c33; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   placeholder="contoh@email.com" 
                                   value="{{ old('email') }}"
                                   required>
                            @error('email') 
                                <div style="color: #c33; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" 
                                      name="message" 
                                      rows="5" 
                                      placeholder="Tulis pesan Anda di sini..." 
                                      required>{{ old('message') }}</textarea>
                            @error('message') 
                                <div style="color: #c33; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="bi bi-send-fill"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- Google Maps Embed --}}
        <div class="map-embed-card">
            <div class="map-embed-header">
                <i class="bi bi-map-fill"></i>
                <h5>Lokasi Kami di Peta</h5>
            </div>
            <div class="map-embed-body">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63835.64768912345!2d128.3349!3d1.8845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMcKwNTMnMDQuMiJOIDEyOMKwMjAnNTMuNiJF!5e0!3m2!1sen!2sid!4v1234567890" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
@endsection