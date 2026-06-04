<header class="school-header">
    <style>
        .school-header {
            background: #1A3A6B;
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .school-header::after {
            content: '';
            display: block;
            height: 3px;
            background: linear-gradient(90deg, #4A90E2, #1A3A6B 40%, #4A90E2);
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 24px;
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .school-brand-logo {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            /* filter: brightness(0) invert(1); */
        }

        .school-brand-divider {
            width: 1px;
            height: 36px;
            background: rgba(255, 255, 255, 0.2);
        }

        .school-brand-text {}

        .school-brand-name {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }

        .school-brand-tagline {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            color: rgba(74, 144, 226, 0.9);
            letter-spacing: 0.5px;
            margin: 0;
        }

        .school-nav {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .school-nav-link {
            font-family: 'Inter', sans-serif;
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.80);
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            transition: background 0.18s ease, color 0.18s ease;
            white-space: nowrap;
        }

        .school-nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .school-nav-link.active {
            background: rgba(74, 144, 226, 0.22);
            color: #ffffff;
            position: relative;
        }

        .school-nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 14px;
            right: 14px;
            height: 2px;
            background: #4A90E2;
            border-radius: 2px 2px 0 0;
        }

        .header-menu-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: background 0.18s ease;
        }

        .header-menu-btn:hover {
            background: rgba(255, 255, 255, 0.18);
        }
    </style>

    <div class="container-xl header-inner">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="school-brand">
            <img src="{{ asset('assets/icon/logo.png') }}" alt="Logo" class="school-brand-logo">
            <div class="school-brand-divider"></div>
            <div class="school-brand-text">
                <p class="school-brand-name">SMA NEGERI 5 MOROTAI</p>
                <p class="school-brand-tagline">Cerdas, Beriman, Berbudaya</p>
            </div>
        </a>

        {{-- Desktop Navigation --}}
        <nav class="school-nav d-none d-md-flex">
            <a href="{{ route('home') }}"
               class="school-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
            </a>
            <a href="{{ route('announcements.index') }}"
               class="school-nav-link {{ request()->routeIs('announcements.*') ? 'active' : '' }}">
                Pengumuman
            </a>
            <a href="{{ route('news.index') }}"
               class="school-nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}">
                Berita
            </a>
            <a href="{{ route('map.index') }}"
               class="school-nav-link {{ request()->routeIs('map.*') ? 'active' : '' }}">
                Peta Siswa
            </a>
            <div class="dropdown d-none d-md-block" style="position: relative;">
                <a href="#" class="school-nav-link dropdown-toggle {{ request()->routeIs('profile.*','students.*') ? 'active' : '' }}"
                   id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;">
                    Profil
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown" style="background:#fff; border-radius: 14px; overflow:hidden;">
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profil</a></li>
                    <li><a class="dropdown-item" href="{{ route('students.index') }}">Siswa</a></li>
                </ul>
            </div>

            <a href="{{ route('contact.index') }}"
               class="school-nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                Kontak
            </a>
            <a href="{{ route('documents.index') }}" class="school-nav-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">Satu Data</a>

        </nav>

        {{-- Mobile Hamburger --}}
        {{-- <button class="header-menu-btn d-md-none border-0" type="button">
            <i class="bi bi-list"></i>
        </button> --}}

    </div>
</header>