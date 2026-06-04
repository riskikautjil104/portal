<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎯 Dashboard Sistem
        </h2>
    </x-slot>

    <div class="py-4">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-700 to-indigo-800 rounded-2xl p-6 text-white shadow-lg mb-8 relative overflow-hidden">
            <div class="absolute right-0 bottom-0 opacity-10 translate-x-4 translate-y-4">
                <i class="ph ph-squares-four text-[180px]"></i>
            </div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider">
                        Selamat Datang kembali, {{ auth()->user()->role }}!
                    </span>
                    <h1 class="text-2xl md:text-3xl font-bold mt-2">Halo, {{ auth()->user()->name }}</h1>
                    <p class="text-blue-100 text-sm mt-1">Sistem informasi portal sekolah siap dikelola. Pantau performa web hari ini.</p>
                </div>
                <div class="px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-right">
                    <div class="text-xs text-blue-200">Hari & Tanggal</div>
                    <div class="font-bold text-sm md:text-base">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Role-based Statistics -->
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <i class="ph ph-chart-bar text-xl text-blue-600"></i> Statistik Portal
        </h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Universal Stats: Announcements & News -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition duration-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                    <i class="ph ph-megaphone"></i>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ $stats['announcements'] }}</div>
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-0.5">Pengumuman</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition duration-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl">
                    <i class="ph ph-newspaper"></i>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ $stats['news'] }}</div>
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-0.5">Berita</div>
                </div>
            </div>

            <!-- Admin-only Stats -->
            @if(auth()->user()->isAdmin())
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition duration-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                    <i class="ph ph-users-three"></i>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ $stats['students'] }}</div>
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-0.5">Siswa Terdaftar</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition duration-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    <i class="ph ph-chalkboard-teacher"></i>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ $stats['teachers'] }}</div>
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-0.5">Data Guru</div>
                </div>
            </div>
            @endif

            <!-- Humas Stats -->
            @if(auth()->user()->isHumas())
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition duration-200 flex items-center gap-4 col-span-1 sm:col-span-2">
                <div class="w-12 h-12 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-2xl">
                    <i class="ph ph-buildings"></i>
                </div>
                <div>
                    <div class="text-sm font-bold text-gray-900">Profil Sekolah Aktif</div>
                    <div class="text-xs font-semibold text-gray-500 mt-0.5">Sambutan & Organigram Terkelola</div>
                </div>
            </div>
            @endif
        </div>

        <!-- Quick Navigation -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Navigasi Akses Cepat</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-3 p-4 bg-blue-50/50 hover:bg-blue-50 text-blue-900 rounded-xl transition duration-150 border border-blue-100/50 font-semibold text-sm">
                        <i class="ph ph-megaphone text-xl text-blue-600"></i> Kelola Pengumuman
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 p-4 bg-purple-50/50 hover:bg-purple-50 text-purple-900 rounded-xl transition duration-150 border border-purple-100/50 font-semibold text-sm">
                        <i class="ph ph-newspaper text-xl text-purple-600"></i> Kelola Berita
                    </a>
                    <a href="{{ route('admin.teachers.index') }}" class="flex items-center gap-3 p-4 bg-amber-50/50 hover:bg-amber-50 text-amber-900 rounded-xl transition duration-150 border border-amber-100/50 font-semibold text-sm">
                        <i class="ph ph-chalkboard-teacher text-xl text-amber-600"></i> Kelola Data Guru
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="flex items-center gap-3 p-4 bg-emerald-50/50 hover:bg-emerald-50 text-emerald-900 rounded-xl transition duration-150 border border-emerald-100/50 font-semibold text-sm">
                        <i class="ph ph-users-three text-xl text-emerald-600"></i> Kelola Data Siswa
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="flex items-center gap-3 p-4 bg-cyan-50/50 hover:bg-cyan-50 text-cyan-900 rounded-xl transition duration-150 border border-cyan-100/50 font-semibold text-sm">
                        <i class="ph ph-door text-xl text-cyan-600"></i> Kelola Ruangan
                    </a>
                    <a href="{{ route('admin.map.index') }}" class="flex items-center gap-3 p-4 bg-indigo-50/50 hover:bg-indigo-50 text-indigo-900 rounded-xl transition duration-150 border border-indigo-100/50 font-semibold text-sm">
                        <i class="ph ph-map-pin text-xl text-indigo-600"></i> Peta Sebaran Siswa
                    </a>
                    <a href="{{ route('admin.portal-links.index') }}" class="flex items-center gap-3 p-4 bg-teal-50/50 hover:bg-teal-50 text-teal-900 rounded-xl transition duration-150 border border-teal-100/50 font-semibold text-sm">
                        <i class="ph ph-link text-xl text-teal-600"></i> Kelola Portal Links
                    </a>
                    <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 p-4 bg-rose-50/50 hover:bg-rose-50 text-rose-900 rounded-xl transition duration-150 border border-rose-100/50 font-semibold text-sm">
                        <i class="ph ph-images text-xl text-rose-600"></i> Hero Carousel Banners
                    </a>
                    <a href="{{ route('admin.school-profile.index') }}" class="flex items-center gap-3 p-4 bg-orange-50/50 hover:bg-orange-50 text-orange-900 rounded-xl transition duration-150 border border-orange-100/50 font-semibold text-sm">
                        <i class="ph ph-buildings text-xl text-orange-600"></i> Profil & Organigram
                    </a>
                @endif

                @if(auth()->user()->isHumas())
                    <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-3 p-4 bg-blue-50/50 hover:bg-blue-50 text-blue-900 rounded-xl transition duration-150 border border-blue-100/50 font-semibold text-sm">
                        <i class="ph ph-megaphone text-xl text-blue-600"></i> Kelola Pengumuman
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 p-4 bg-purple-50/50 hover:bg-purple-50 text-purple-900 rounded-xl transition duration-150 border border-purple-100/50 font-semibold text-sm">
                        <i class="ph ph-newspaper text-xl text-purple-600"></i> Tulis & Edit Berita
                    </a>
                    <a href="{{ route('admin.school-profile.index') }}" class="flex items-center gap-3 p-4 bg-orange-50/50 hover:bg-orange-50 text-orange-900 rounded-xl transition duration-150 border border-orange-100/50 font-semibold text-sm">
                        <i class="ph ph-buildings text-xl text-orange-600"></i> Kelola Profil Sekolah
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
