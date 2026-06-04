@extends('layouts.public')

@section('title', 'Peta Siswa - SMA Negeri 5 Morotai')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    <style>
        :root {
            --blue-dark: #1A3A6B;
            --blue-mid:  #2A5298;
            --blue-acc:  #4A90E2;
        }

        /* ── Page Hero (Konsisten dengan halaman lain) ── */
        /* .page-hero {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-mid) 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
            color: white;
        } */
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

        /* ── Stats Bar (Ringkasan Data Peta) ── */
        .map-stats-bar {
            background: #ffffff;
            border-radius: 18px;
            padding: 24px 28px;
            margin-bottom: 28px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0;
            box-shadow: 0 4px 20px rgba(26, 58, 107, 0.06);
            border: 1px solid rgba(26, 58, 107, 0.06);
        }

        .map-stat-item {
            text-align: center;
            padding: 12px 16px;
            position: relative;
        }

        .map-stat-item + .map-stat-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 1px;
            background: rgba(26, 58, 107, 0.10);
        }

        .map-stat-number {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--blue-dark);
            line-height: 1;
            margin-bottom: 6px;
        }

        .map-stat-number span { color: var(--blue-acc); }

        .map-stat-label {
            font-size: 0.75rem;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── Map Container Card ── */
        .map-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(26, 58, 107, 0.08);
            border: 1px solid rgba(26, 58, 107, 0.05);
            margin-bottom: 32px;
        }

        .map-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(26, 58, 107, 0.06);
        }

        .map-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--blue-dark);
            margin: 0;
        }

        .map-title i {
            color: var(--blue-acc);
            font-size: 1.3rem;
        }

        .map-legend {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: #6b7280;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--blue-dark);
            box-shadow: 0 0 0 3px rgba(26, 58, 107, 0.2);
        }

        #map {
            height: 600px;
            border-radius: 16px;
            z-index: 1;
        }

        /* ── Custom Popup Styling ── */
        .custom-popup .leaflet-popup-content-wrapper {
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            padding: 0;
            overflow: hidden;
        }

        .custom-popup .leaflet-popup-content {
            margin: 0;
            min-width: 240px;
        }

        .popup-header {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue-mid));
            padding: 14px 18px;
            color: white;
        }

        .popup-header h6 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .popup-body {
            padding: 16px 18px;
        }

        .popup-desc {
            font-size: 0.82rem;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .popup-stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 14px;
            background: #EEF3FC;
            border-radius: 10px;
            font-size: 0.85rem;
        }

        .popup-stat-label {
            color: #4a5568;
            font-weight: 500;
        }

        .popup-stat-value {
            color: var(--blue-dark);
            font-weight: 800;
            font-size: 1rem;
        }

        /* ── Info Section Card ── */
        .map-info-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(26,58,107,0.06);
            box-shadow: 0 4px 16px rgba(26,58,107,0.04);
            overflow: hidden;
        }

        .map-info-header {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue-mid));
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .map-info-header i { color: var(--blue-acc); font-size: 1.1rem; }
        .map-info-header span { 
            font-family: 'Poppins', sans-serif; 
            font-size: 0.9rem; 
            font-weight: 700; 
            color: #ffffff; 
        }

        .map-info-body {
            padding: 24px 20px;
        }

        .map-info-body p {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.7;
            margin: 0;
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
            #map { height: 400px; }
            .map-card { padding: 16px; }
            .map-stats-bar { 
                grid-template-columns: 1fr; 
                gap: 16px; 
            }
            .map-stat-item + .map-stat-item::before { display: none; }
            .map-header { flex-direction: column; align-items: flex-start; gap: 10px; }
        }
    </style>
@endpush

@section('hero')
    <div class="page-hero">
        
            <div class="page-hero-eyebrow">
                <i class="bi bi-map"></i>
                Portal Sekolah
            </div>
            <h1>Peta Sebaran Siswa</h1>
            <p>Visualisasi interaktif lokasi asal siswa SMA Negeri 5 Morotai di seluruh Kabupaten Pulau Morotai dan sekitarnya.</p>
       
    </div>
@endsection

@section('content')
    <div  style="margin-bottom: 80px;">

        {{-- Stats Bar (Ringkasan Data) --}}
        @php
            $totalSiswa = collect($locations)->sum('student_count');
            $totalLokasi = count($locations);
        @endphp

        @if($totalLokasi > 0)
            <div class="map-stats-bar">
                <div class="map-stat-item">
                    <div class="map-stat-number">{{ number_format($totalSiswa) }}</div>
                    <div class="map-stat-label">Total Siswa</div>
                </div>
                <div class="map-stat-item">
                    <div class="map-stat-number">{{ $totalLokasi }}</div>
                    <div class="map-stat-label">Lokasi Tersebar</div>
                </div>
                <div class="map-stat-item">
                    <div class="map-stat-number">{{ $totalLokasi }}</div>
                    <div class="map-stat-label">Desa/Kelurahan</div>
                </div>
            </div>
        @endif

        {{-- Map Card --}}
        <div class="map-card">
            <div class="map-header">
                <h5 class="map-title">
                    <i class="bi bi-geo-alt-fill"></i>
                    Peta Interaktif
                </h5>
                <div class="map-legend">
                    <span class="legend-dot"></span>
                    <span>Lokasi Siswa</span>
                </div>
            </div>
            <div id="map"></div>
        </div>

        {{-- Info Section --}}
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="map-info-card">
                    <div class="map-info-header">
                        <i class="bi bi-info-circle"></i>
                        <span>Tentang Peta Ini</span>
                    </div>
                    <div class="map-info-body">
                        <p>
                            Peta ini menunjukkan sebaran geografis tempat tinggal siswa SMA Negeri 5 Morotai. 
                            Setiap titik pada peta mewakili satu desa/kelurahan yang menjadi tempat tinggal siswa kami. 
                            Klik pada marker untuk melihat detail jumlah siswa di lokasi tersebut.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="map-info-card">
                    <div class="map-info-header">
                        <i class="bi bi-lightbulb"></i>
                        <span>Cara Menggunakan</span>
                    </div>
                    <div class="map-info-body">
                        <p>
                            <strong>Zoom:</strong> Gunakan scroll mouse atau tombol + / -<br>
                            <strong>Pan:</strong> Klik dan geser peta<br>
                            <strong>Detail:</strong> Klik marker biru untuk melihat info lokasi
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Empty State (jika tidak ada data) --}}
        @if($totalLokasi === 0)
            <div class="empty-state mt-4">
                <div class="empty-state-icon">
                    <i class="bi bi-map"></i>
                </div>
                <h5 style="font-weight: 700; color: #1a202c; margin-bottom: 8px;">Belum ada data lokasi</h5>
                <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">
                    Data sebaran siswa akan muncul di sini saat tersedia.
                </p>
            </div>
        @endif

    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script>
        // Initialize map
        const map = L.map('map', {
            scrollWheelZoom: false // Disable scroll zoom biar nggak conflict sama scroll page
        }).setView([1.8845, 128.3649], 10);

        // Tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Custom marker icon (matching design system)
        const customIcon = L.divIcon({
            className: 'custom-marker',
            html: `
                <div style="
                    width: 32px;
                    height: 32px;
                    background: linear-gradient(135deg, #1A3A6B, #2A5298);
                    border-radius: 50% 50% 50% 0;
                    transform: rotate(-45deg);
                    border: 3px solid white;
                    box-shadow: 0 4px 12px rgba(26, 58, 107, 0.4);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <i class="bi bi-person-fill" style="
                        color: white;
                        font-size: 14px;
                        transform: rotate(45deg);
                    "></i>
                </div>
            `,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        // Plot markers from DB
        const locations = @json($locations);
        
        if (locations.length > 0) {
            const markerGroup = L.featureGroup();

            locations.forEach(loc => {
                const total = parseInt(loc.student_count ?? 0);
                const locationName = loc.village_name ?? loc.name ?? 'Lokasi';
                const description = loc.description ?? '';

                // Custom popup content
                const popupContent = `
                    <div class="popup-header">
                        <h6>${locationName}</h6>
                    </div>
                    <div class="popup-body">
                        ${description ? `<div class="popup-desc">${description}</div>` : ''}
                        <div class="popup-stat">
                            <span class="popup-stat-label">Total Siswa</span>
                            <span class="popup-stat-value">${total}</span>
                        </div>
                    </div>
                `;

                const marker = L.marker([loc.latitude, loc.longitude], {
                    icon: customIcon
                }).bindPopup(popupContent, {
                    className: 'custom-popup',
                    maxWidth: 280
                });

                markerGroup.addLayer(marker);
            });

            markerGroup.addTo(map);
            map.fitBounds(markerGroup.getBounds().pad(0.15));
        } else {
            // Default marker jika tidak ada data
            L.marker([1.8845, 128.3649], { icon: customIcon })
                .addTo(map)
                .bindPopup(`
                    <div class="popup-header">
                        <h6>SMA Negeri 5 Morotai</h6>
                    </div>
                    <div class="popup-body">
                        <div class="popup-desc">Lokasi default peta</div>
                    </div>
                `, {
                    className: 'custom-popup'
                })
                .openPopup();
        }

        // Enable scroll zoom saat map di-klik
        map.on('click', function() {
            map.scrollWheelZoom.enable();
        });

        // Disable scroll zoom saat mouse keluar dari map
        map.on('mouseout', function() {
            map.scrollWheelZoom.disable();
        });
    </script>
@endpush