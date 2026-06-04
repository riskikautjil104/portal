<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Panel - SMA 5 Morotai') }}</title>
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons (Phosphor Icons / Bootstrap Icons) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- TinyMCE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        
        .sidebar {
            background: linear-gradient(145deg, #1A3A6B 0%, #2A5298 100%);
        }
        
        .nav-item {
            transition: all 0.3s ease;
        }
        
        .nav-item:hover, .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-left: 4px solid #4A90E2;
            color: #ffffff !important;
        }
        
        .main-content {
            background-color: #F8F9FA;
        }
        
        /* Glassmorphism Card Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800" x-data="{ sidebarOpen: false }">

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" x-transition.opacity 
         class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
         @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="sidebar fixed inset-y-0 left-0 z-30 w-64 text-white transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col h-screen">
        
        <!-- Sidebar Header -->
        <div class="flex items-center justify-center h-20 border-b border-white border-opacity-20 px-6">
            <h1 class="text-xl font-bold tracking-wider text-white">Admin Portal</h1>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            
            <p class="px-4 text-xs font-semibold text-blue-200 uppercase tracking-wider mb-2 mt-4">Menu Utama</p>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ph ph-squares-four text-xl mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.announcements.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                <i class="ph ph-megaphone text-xl mr-3"></i>
                <span class="font-medium">Pengumuman</span>
            </a>

            <a href="{{ route('admin.documents.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                <i class="ph ph-file-text text-xl mr-3"></i>
                <span class="font-medium">Dokumen</span>
            </a>


            <a href="{{ route('admin.news.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="ph ph-newspaper text-xl mr-3"></i>
                <span class="font-medium">Berita Sekolah</span>
            </a>

            <p class="px-4 text-xs font-semibold text-blue-200 uppercase tracking-wider mb-2 mt-6">Akademik & Fasilitas</p>
            
            <a href="{{ route('admin.teachers.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                <i class="ph ph-chalkboard-teacher text-xl mr-3"></i>
                <span class="font-medium">Data Guru</span>
            </a>
            
            <a href="{{ route('admin.students.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="ph ph-users-three text-xl mr-3"></i>
                <span class="font-medium">Data Siswa</span>
            </a>
            
            <a href="{{ route('admin.rooms.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                <i class="ph ph-door text-xl mr-3"></i>
                <span class="font-medium">Ruangan</span>
            </a>

            <p class="px-4 text-xs font-semibold text-blue-200 uppercase tracking-wider mb-2 mt-6">Manajemen Web</p>
            
            <a href="{{ route('admin.map.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.map.*') ? 'active' : '' }}">
                <i class="ph ph-map-pin text-xl mr-3"></i>
                <span class="font-medium">Peta Siswa</span>
            </a>

            <a href="{{ route('admin.portal-links.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.portal-links.*') ? 'active' : '' }}">
                <i class="ph ph-link text-xl mr-3"></i>
                <span class="font-medium">Portal Links</span>
            </a>
            
            <a href="{{ route('admin.banners.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                <i class="ph ph-images text-xl mr-3"></i>
                <span class="font-medium">Hero Banners</span>
            </a>

            <a href="{{ route('admin.school-profile.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.school-profile.*') ? 'active' : '' }}">
                <i class="ph ph-buildings text-xl mr-3"></i>
                <span class="font-medium">Profil Sekolah</span>
            </a>
            @endif

            @if(auth()->user()->isHumas())
            <a href="{{ route('admin.announcements.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                <i class="ph ph-megaphone text-xl mr-3"></i>
                <span class="font-medium">Kelola Pengumuman</span>
            </a>

            <a href="{{ route('admin.news.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="ph ph-newspaper text-xl mr-3"></i>
                <span class="font-medium">Kelola Berita</span>
            </a>
            
            <a href="{{ route('admin.school-profile.index') }}" 
               class="nav-item flex items-center px-4 py-3 text-blue-100 rounded-lg {{ request()->routeIs('admin.school-profile.*') ? 'active' : '' }}">
                <i class="ph ph-buildings text-xl mr-3"></i>
                <span class="font-medium">Profil Sekolah</span>
            </a>
            @endif
        </nav>

        <!-- Sidebar Footer (Logout) -->
        <div class="p-4 border-t border-white border-opacity-20">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-3 text-red-300 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300">
                    <i class="ph ph-sign-out text-xl mr-3"></i>
                    <span class="font-medium">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-64 transition-all duration-300 main-content">
        
        <!-- Header -->
        <header class="flex items-center justify-between h-20 px-6 bg-white border-b border-gray-200 shadow-sm z-10">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <i class="ph ph-list text-2xl"></i>
            </button>
            
            <div class="flex-1 px-4 lg:px-0">
                <h2 class="text-xl font-semibold text-gray-800">{{ $header ?? '' }}</h2>
            </div>
            
            <div class="flex items-center">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-700">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 uppercase">{{ auth()->user()->role }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 sm:p-8 overflow-y-auto">
            {{-- Support both Blade component (<x-admin-layout>) and traditional extends (@extends('layouts.admin')) --}}
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
                @yield('main')
            @endisset
        </main>

        



        
        <!-- Footer -->
        <footer class="p-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} SMA Negeri 5 Morotai. All rights reserved.
        </footer>
    </div>

    <!-- SweetAlert Flash Messages Initialization -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#1A3A6B'
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#DC3545'
            });
        });
    </script>
    @endif
    
    <!-- Initialize TinyMCE -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(document.querySelector('.wysiwyg-editor')) {
                tinymce.init({
                    selector: '.wysiwyg-editor',
                    height: 400,
                    menubar: false,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:16px }'
                });
            }
        });
    </script>
</body>
</html>
