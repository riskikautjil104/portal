<footer class="site-footer">
    <style>
        .site-footer {
            background: #1A3A6B;
            color: rgba(255,255,255,0.80);
            font-family: 'Inter', sans-serif;
            margin-top: 80px;
        }

        .site-footer a {
            text-decoration: none;
            transition: color 0.18s ease;
        }

        /* ── Top bar accent ── */
        .footer-accent {
            height: 3px;
            background: linear-gradient(90deg, #4A90E2, #1A3A6B 50%, #4A90E2);
        }

        /* ── Main body ── */
        .footer-body {
            padding: 56px 0 40px;
        }

        /* ── Brand column ── */
        .footer-brand-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 4px;
            letter-spacing: 0.3px;
        }

        .footer-tagline {
            font-size: 0.78rem;
            color: #4A90E2;
            letter-spacing: 0.5px;
            margin: 0 0 16px;
        }

        .footer-desc {
            font-size: 0.875rem;
            line-height: 1.7;
            color: rgba(255,255,255,0.55);
            margin: 0 0 24px;
            max-width: 280px;
        }

        .footer-logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .footer-logo-wrap img {
            width: 150px;
            height: 150px;
            /* filter: brightness(0) invert(1); */
            flex-shrink: 0;
        }

        .footer-divider-v {
            width: 1px;
            height: 32px;
            background: rgba(255,255,255,0.15);
        }

        /* ── Social icons ── */
        .footer-socials {
            display: flex;
            gap: 10px;
        }

        .footer-social-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.70);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .footer-social-btn:hover {
            background: #4A90E2;
            border-color: #4A90E2;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* ── Column headings ── */
        .footer-heading {
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin: 0 0 20px;
            position: relative;
            padding-bottom: 12px;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 24px;
            height: 2px;
            background: #4A90E2;
            border-radius: 2px;
        }

        /* ── Nav links ── */
        .footer-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-nav li a {
            font-size: 0.875rem;
            color: rgba(255,255,255,0.55);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .footer-nav li a::before {
            content: '';
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #4A90E2;
            flex-shrink: 0;
            opacity: 0;
            transition: opacity 0.18s ease;
        }

        .footer-nav li a:hover {
            color: #ffffff;
        }

        .footer-nav li a:hover::before {
            opacity: 1;
        }

        /* ── Contact items ── */
        .footer-contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .footer-contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .footer-contact-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(74, 144, 226, 0.15);
            border: 1px solid rgba(74, 144, 226, 0.25);
            color: #4A90E2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .footer-contact-label {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.40);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            display: block;
            margin-bottom: 2px;
        }

        .footer-contact-value {
            font-size: 0.865rem;
            color: rgba(255,255,255,0.75);
        }

        /* ── Bottom bar ── */
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 20px 0;
        }

        .footer-copyright {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.35);
            margin: 0;
        }

        .footer-bottom-links {
            display: flex;
            gap: 20px;
        }

        .footer-bottom-links a {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.35);
        }

        .footer-bottom-links a:hover {
            color: rgba(255,255,255,0.70);
        }

        @media (max-width: 767px) {
            .footer-body { padding: 40px 0 28px; }
            .footer-desc { max-width: 100%; }
            .footer-bottom { text-align: center; }
            .footer-bottom .d-flex { flex-direction: column; gap: 12px; align-items: center; }
            .footer-bottom-links { justify-content: center; }
        }
    </style>

    {{-- Accent line top --}}
    <div class="footer-accent"></div>

    <div class="container-xl footer-body">
        <div class="container row g-5">

            {{-- Brand --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo-wrap">
                    <img src="{{ asset('assets/icon/logo.png') }}" alt="Logo">
                    <div class="footer-divider-v"></div>
                    <div>
                        <p class="footer-brand-name">SMA NEGERI 5 MOROTAI</p>
                        <p class="footer-tagline">Cerdas, Beriman, Berbudaya</p>
                    </div>
                </div>
                <p class="footer-desc">
                    Portal informasi dan layanan terpadu untuk siswa, orang tua, dan seluruh masyarakat Pulau Morotai.
                </p>
                <div class="footer-socials">
                    <a href="#" class="footer-social-btn" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="footer-social-btn" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="footer-social-btn" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="#" class="footer-social-btn" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

            {{-- Nav --}}
            <div class="col-lg-2 col-md-6 col-6">
                <p class="footer-heading">Navigasi</p>
                <ul class="footer-nav">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('announcements.index') }}">Pengumuman</a></li>
                    <li><a href="{{ route('news.index') }}">Berita</a></li>
                    <li><a href="{{ route('map.index') }}">Peta Siswa</a></li>
                    <li><a href="{{ route('profile.index') }}">Profil</a></li>
                    <li><a href="{{ route('contact.index') }}">Kontak</a></li>
                    <li><a href="{{ route('documents.index') }}">Satu Data</a></li>

                </ul>
            </div>

            {{-- Portal --}}
            <div class="col-lg-2 col-md-6 col-6">
                <p class="footer-heading">Portal</p>
                <ul class="footer-nav">
                    <li><a href="#">SIMORO</a></li>
                    <li><a href="#">LMS</a></li>
                    <li><a href="#">Absensi</a></li>
                    <li><a href="#">Website OSIS</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-4 col-md-6">
                <p class="footer-heading">Hubungi Kami</p>
                <ul class="footer-contact-list">
                    <li>
                        <div class="footer-contact-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <span class="footer-contact-label">Alamat</span>
                            <span class="footer-contact-value">Jl. Pendidikan, Pulau Morotai, Maluku Utara</span>
                        </div>
                    </li>
                    <li>
                        <div class="footer-contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <span class="footer-contact-label">Email</span>
                            <span class="footer-contact-value">info@sman5morotai.sch.id</span>
                        </div>
                    </li>
                    <li>
                        <div class="footer-contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <span class="footer-contact-label">Telepon</span>
                            <span class="footer-contact-value">(0927) 321-456</span>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="footer-bottom">
        <div class="container-xl">
            <div class="d-flex justify-content-between align-items-center">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} SMA Negeri 5 Morotai. Semua hak dilindungi.
                </p>
                <div class="footer-bottom-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>

</footer>