<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <i class="bi bi-pencil-square text-2xl text-blue-600"></i>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Titik Lokasi Siswa
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                
                <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                    <a href="{{ route('admin.map.index') }}" class="p-2 hover:bg-gray-50 rounded-lg text-gray-500 transition">
                        <i class="bi bi-arrow-left text-lg"></i>
                    </a>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Ubah Koordinat</h3>
                        <p class="text-xs text-gray-500">Sesuaikan informasi wilayah dan demografi statistik siswa.</p>
                    </div>
                </div>

                <form action="{{ route('admin.map.update', $location->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        <!-- Left Panel: Form Input -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Wilayah / Lokasi</label>
                                <input type="text" name="name" value="{{ old('name', $location->name) }}" placeholder="Contoh: Daruba, Morotai Selatan" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Latitude</label>
                                    <input type="text" name="latitude" id="lat" value="{{ old('latitude', $location->latitude) }}" placeholder="Contoh: 1.8845" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                    @error('latitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Longitude</label>
                                    <input type="text" name="longitude" id="lng" value="{{ old('longitude', $location->longitude) }}" placeholder="Contoh: 128.3649" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                    @error('longitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi / Catatan Tambahan</label>
                                <textarea name="description" placeholder="Catatan singkat tentang wilayah ini..." class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" rows="2">{{ old('description', $location->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="border-t border-gray-100 pt-6">
                                <h4 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="bi bi-people"></i> Demografi Statistik Siswa
                                </h4>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah Siswa Laki-laki</label>
                                        <input type="number" name="male_count" value="{{ old('male_count', $location->male_count) }}" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                        @error('male_count')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah Siswa Perempuan</label>
                                        <input type="number" name="female_count" value="{{ old('female_count', $location->female_count) }}" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                        @error('female_count')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah Siswa Aktif</label>
                                        <input type="number" name="active_count" value="{{ old('active_count', $location->active_count) }}" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                        @error('active_count')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah Alumni</label>
                                        <input type="number" name="alumni_count" value="{{ old('alumni_count', $location->alumni_count) }}" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                                        @error('alumni_count')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                                <a href="{{ route('admin.map.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg shadow-sm transition duration-150 text-sm">
                                    Batal
                                </a>
                                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 text-sm flex items-center gap-2">
                                    <i class="bi bi-floppy"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>

                        <!-- Right Panel: Clickable Guide Map -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Pilih Lokasi di Peta</label>
                                <p class="text-xs text-gray-400 mb-2">Klik pada peta di bawah untuk menggeser/mengambil titik koordinat baru.</p>
                                <div id="input-map" class="w-full" style="height: 480px; border-radius: 12px; border: 1px solid #e2e8f0; z-index: 1;"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Leaflet Assets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startLat = {{ $location->latitude }};
            const startLng = {{ $location->longitude }};
            
            // Set view centered on current location
            const map = L.map('input-map').setView([startLat, startLng], 12);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add marker at existing coordinates
            let marker = L.marker([startLat, startLng]).addTo(map);

            // Click listener to update coordinates
            map.on('click', function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                
                document.getElementById('lat').value = lat.toFixed(6);
                document.getElementById('lng').value = lng.toFixed(6);
                
                marker.setLatLng(e.latlng);
            });
        });
    </script>
</x-admin-layout>
