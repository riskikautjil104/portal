<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'SMA Negeri 5 Morotai') }}</title>

    {{-- SEO (default, bisa di-override dari controller via $seo*) --}}
    @php
        $seoDescription = $seoDescription ?? 'Portal informasi dan layanan terpadu SMA Negeri 5 Morotai. Berita dan pengumuman terbaru tersedia di halaman ini.';
        $seoCanonical = $seoCanonical ?? url()->current();
        $seoImage = $seoImage ?? asset('assets/img/tutwuri.jpeg');
    @endphp

    <meta name="description" content="{{ $seoDescription }}">
    <link rel="canonical" href="{{ $seoCanonical }}">

    {{-- OpenGraph --}}
    <meta property="og:title" content="{{ $title ?? config('app.name', 'SMA Negeri 5 Morotai') }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $seoImage }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? config('app.name', 'SMA Negeri 5 Morotai') }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">


    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">


    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #1A3A6B;
            --secondary: #4A90E2;
            --light: #E8F0FE;
            --bg: #F8F9FA;
            --text: #212529;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            padding-bottom: 70px; /* Space for bottom nav on mobile */
        }

        @media (min-width: 768px) {
            body {
                padding-bottom: 0;
            }
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        a {
            color: var(--primary);
            text-decoration: none;
        }

        a:hover {
            color: var(--secondary);
        }

        .page-container {
            padding: 60px 0;
        }

        /* Loading Screen Styling */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #ffffff;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity 0.5s ease-out, visibility 0.5s;
        }

        #loading-screen.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        .loader-text {
            color: var(--primary);
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 1px;
            font-size: 1.1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Mobile Bottom Nav Bar */
        .mobile-bottom-nav {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
            z-index: 999;
        }

        .mobile-bottom-nav-item {
            color: #6c757d;
            font-size: 0.7rem;
            font-weight: 500;
            text-align: center;
            flex: 1;
            padding: 8px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            transition: color 0.2s ease;
        }

        .mobile-bottom-nav-item i {
            font-size: 1.3rem;
            transition: transform 0.2s ease;
        }

        .mobile-bottom-nav-item:hover,
        .mobile-bottom-nav-item.active {
            color: var(--primary);
        }

        .mobile-bottom-nav-item:active i {
            transform: scale(0.9);
        }
                /* Override container untuk tampilan laptop/desktop */
        @media (min-width: 768px) {
            .content-area {
                max-width: 100% !important; /* Menonaktifkan max-width bawaan .container agar full-width */
                padding-left: 50px !important;
                padding-right: 50px !important;
            }
        }
        /* Gradient biru muda di bagian bawah halaman */
body::after {
    content: '';
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40vh;
    background: linear-gradient(to bottom, 
        rgba(173,216,230,0) 0%, 
        rgba(173,216,230,0.25) 60%, 
        rgba(135,206,250,0.35) 100%);
    pointer-events: none;
    z-index: 0;
}
/* Background 3 Section */
.bg-section {
    position: fixed;
    left: 0;
    width: 100%;
    z-index: -1;
    pointer-events: none;
}

.bg-top {
    top: 0;
    height: 25vh;
    background: #ffffff;
}

.bg-middle {
    top: 25vh;
    height: 50vh;
    background: linear-gradient(
        to bottom,
        #E3F2FD 0%,
        #d1d8de 50%,
        #E3F2FD 100%
    );
}

.bg-bottom {
    top: 75vh;
    height: 25vh;
    background: #ffffff;
}

/* Canvas hanya muncul di section tengah */
#abstract-bg {
    position: fixed;
    top: 25vh;
    height: 50vh;
    opacity: 0.6;
}
    /* ── Mobile Filter Scroll ── */
    @media (max-width: 576px) {
        .filter-bar {
            flex-wrap: nowrap;          /* Jangan turun ke bawah */
            overflow-x: auto;           /* Bisa di-scroll ke samping */
            padding-bottom: 8px;        /* Ruang untuk scrollbar */
            -webkit-overflow-scrolling: touch; /* Scroll halus di iOS */
            scrollbar-width: none;      /* Sembunyikan scrollbar di Firefox */
        }
        .filter-bar::-webkit-scrollbar {
            display: none;              /* Sembunyikan scrollbar di Chrome/Safari */
        }
        .filter-chip {
            flex-shrink: 0;             /* Mencegah tombol mengecil/gepeng */
            white-space: nowrap;
        }
    }
     .page-hero {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
        padding: 60px 60px;
        position: relative;
        overflow: hidden;
        color: white;
    }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="loader-spinner"></div>
        <div class="loader-text">SMA NEGERI 5 MOROTAI</div>
    </div>

    @include('layouts.components.header')

    {{-- <main class="page-container">
        <div class="container-xl">
            @yield('content')
        </div>
    </main> --}}
    {{-- Di <main> --}}
        <div class="bg-section bg-top"></div>
<div class="bg-section bg-middle"></div>
<div class="bg-section bg-bottom"></div>
<main style="position: relative;">
    <canvas id="abstract-bg" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:0;pointer-events:none;opacity:0.55;"></canvas>

    {{-- HERO SLOT — full width, di luar container --}}
    <div style="position:relative;z-index:1;">
        @yield('hero')
    </div>

    {{-- Konten biasa — dalam container --}}
    <div class="container content-area" style="position:relative;z-index:1; padding-top: 20px; ">
        @yield('content')
    </div>
</main>

    @include('layouts.components.footer')

    <!-- Mobile Bottom Navigation Bar -->
    <div class="fixed-bottom d-md-none mobile-bottom-nav d-flex justify-content-around">
        <a href="{{ route('home') }}" class="mobile-bottom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('announcements.index') }}" class="mobile-bottom-nav-item {{ request()->routeIs('announcements.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i>
            <span>Pengumuman</span>
        </a>
        <a href="{{ route('news.index') }}" class="mobile-bottom-nav-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i>
            <span>Berita</span>
        </a>
        <a href="{{ route('map.index') }}" class="mobile-bottom-nav-item {{ request()->routeIs('map.*') ? 'active' : '' }}">
            <i class="bi bi-map"></i>
            <span>Peta</span>
        </a>
        <a href="{{ route('profile.index') }}" class="mobile-bottom-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-info-circle"></i>
            <span>Profil</span>
        </a>
        <a href="{{ route('documents.index') }}" class="mobile-bottom-nav-item {{ request()->routeIs('documents.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Dokumen</span>
        </a>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Loading Screen Script -->
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loading-screen');
            loader.classList.add('fade-out');
            setTimeout(function() {
                loader.style.display = 'none';
            }, 500); // matches CSS transition duration
        });
    </script>
    <script>
(function() {
    const canvas = document.getElementById('abstract-bg');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W, H, shapes, mouse = { x: 0, y: 0 }, scrollY = 0;

    const COLORS = [
        'rgba(26,58,107,',
        'rgba(74,144,226,',
        'rgba(42,82,152,',
        'rgba(16,40,80,',
        'rgba(100,160,230,',
    ];

    function randomBetween(a, b) { return a + Math.random() * (b - a); }

    function buildShapes() {
        shapes = [];
        const count = Math.floor(W / 180) * 5 + 6;
        for (let i = 0; i < count; i++) {
            const pointCount = Math.floor(randomBetween(5, 11));
            const cx = randomBetween(-100, W + 100);
            const cy = randomBetween(-150, H + 150);
            const r1 = randomBetween(60, 220);
            const r2 = randomBetween(r1 * 0.35, r1 * 0.75);
            const twist = randomBetween(-1.2, 1.2);
            const color = COLORS[Math.floor(Math.random() * COLORS.length)];
            const alpha = randomBetween(0.04, 0.13);
            const speed = randomBetween(0.06, 0.22);
            const parallaxDepth = randomBetween(0.04, 0.22);
            const driftX = randomBetween(-0.15, 0.15);
            const driftY = randomBetween(-0.08, 0.08);
            const phase = randomBetween(0, Math.PI * 2);
            const breathe = randomBetween(0.006, 0.018);
            shapes.push({ cx, cy, r1, r2, pointCount, twist, color, alpha, speed, parallaxDepth, driftX, driftY, phase, breathe, t: phase });
        }
    }

    function drawBlob(s, time) {
        const px = (mouse.x / W - 0.5) * W * s.parallaxDepth;
        // const py = (scrollY * s.parallaxDepth * 0.4);
        const py = (scrollY * s.parallaxDepth * 1.8);
        const yOffset = window.innerHeight * 0.25;
            const x = s.cx + px + Math.sin(time * s.driftX + s.phase) * 30;
    const y = s.cy - py + Math.cos(time * s.driftY + s.phase) * 18 + yOffset;
        // const x = s.cx + px + Math.sin(time * s.driftX + s.phase) * 30;
        // const y = s.cy - py + Math.cos(time * s.driftY + s.phase) * 18;
        const breathScale = 1 + Math.sin(time * s.breathe + s.phase) * 0.12;
        const r1 = s.r1 * breathScale;
        const r2 = s.r2 * breathScale;
        const n = s.pointCount;
        const angleStep = (Math.PI * 2) / n;

        ctx.beginPath();
        for (let i = 0; i <= n; i++) {
            const angle = i * angleStep + time * s.speed * 0.3;
            const radius = i % 2 === 0 ? r1 : r2;
            const wobble = Math.sin(time * 0.7 + i * 1.3 + s.phase) * r1 * 0.08;
            const px2 = x + Math.cos(angle + s.twist) * (radius + wobble);
            const py2 = y + Math.sin(angle + s.twist) * (radius + wobble) * 0.8;
            if (i === 0) ctx.moveTo(px2, py2);
            else {
                const prevAngle = (i - 1) * angleStep + time * s.speed * 0.3;
                const prevR = (i - 1) % 2 === 0 ? r1 : r2;
                const pw = Math.sin(time * 0.7 + (i-1) * 1.3 + s.phase) * r1 * 0.08;
                const ppx = x + Math.cos(prevAngle + s.twist) * (prevR + pw);
                const ppy = y + Math.sin(prevAngle + s.twist) * (prevR + pw) * 0.8;
                const cpx = (ppx + px2) / 2;
                const cpy = (ppy + py2) / 2;
                ctx.quadraticCurveTo(ppx, ppy, cpx, cpy);
            }
        }
        ctx.closePath();
        ctx.fillStyle = s.color + s.alpha + ')';
        ctx.fill();
    }

    function resize() {
        W = canvas.width = window.innerWidth;
        // H = canvas.height = window.innerHeight;
         H = canvas.height = window.innerHeight * 0.5; 
        buildShapes();
    }

    let raf, lastTime = 0;
    function loop(ts) {
        const time = ts / 1000;
        ctx.clearRect(0, 0, W, H);
        shapes.forEach(s => drawBlob(s, time));
          canvas.style.transform = `translateY(${scrollY * 0.4}px)`;
    
    raf = requestAnimationFrame(loop);
        // raf = requestAnimationFrame(loop);
    }

    window.addEventListener('resize', resize);
    window.addEventListener('scroll', () => { scrollY = window.scrollY; }, { passive: true });
    window.addEventListener('mousemove', e => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    }, { passive: true });

    resize();
    requestAnimationFrame(loop);
})();
</script>
    @stack('scripts')
    
</body>
</html>
