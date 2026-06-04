<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <i class="bi bi-map text-2xl text-blue-600"></i>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Peta Siswa
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Map Container -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-6">
                <div id="admin-map" class="w-full" style="height: 500px; border-radius: 12px; border: 1px solid #e2e8f0; z-index: 1;"></div>
            </div>

            <!-- Table Container -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Titik Sebaran Siswa</h3>
                        <p class="text-xs text-gray-500">Kumpulan koordinat dan statistik siswa per daerah asal.</p>
                    </div>
                    <a href="{{ route('admin.map.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg shadow-sm transition duration-150 flex items-center gap-2">
                        <i class="bi bi-plus-circle"></i> Tambah Titik Lokasi
                    </a>
                </div>

                <div class="overflow-x-auto border border-gray-100 rounded-lg">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-700 font-semibold">
                                <th class="px-6 py-4">Nama Lokasi</th>
                                <th class="px-6 py-4">Koordinat (Lat, Lng)</th>
                                <th class="px-6 py-4 text-center">L / P</th>
                                <th class="px-6 py-4 text-center">Aktif / Alumni</th>
                                <th class="px-6 py-4 text-center">Total Siswa</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            @forelse($locations as $loc)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $loc->name }}</td>
                                    <td class="px-6 py-4 font-mono text-xs">
                                        {{ number_format($loc->latitude, 6) }}, {{ number_format($loc->longitude, 6) }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center gap-1 text-blue-600 font-medium">
                                            <i class="bi bi-gender-male"></i>{{ $loc->male_count }}
                                        </span>
                                        <span class="mx-1 text-gray-300">|</span>
                                        <span class="inline-flex items-center gap-1 text-pink-600 font-medium">
                                            <i class="bi bi-gender-female"></i>{{ $loc->female_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center gap-1 text-emerald-600 font-medium">
                                            <i class="bi bi-check-circle"></i>{{ $loc->active_count }}
                                        </span>
                                        <span class="mx-1 text-gray-300">|</span>
                                        <span class="inline-flex items-center gap-1 text-purple-600 font-medium">
                                            <i class="bi bi-award"></i>{{ $loc->alumni_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold text-gray-900">
                                        {{ $loc->male_count + $loc->female_count }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.map.edit', $loc->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                                <i class="bi bi-pencil-square text-base"></i>
                                            </a>
                                            
                                            <form action="{{ route('admin.map.destroy', $loc->id) }}" method="POST" class="delete-form-{{ $loc->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $loc->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                    <i class="bi bi-trash text-base"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                        <i class="bi bi-geo-alt text-4xl block mb-2"></i>
                                        Belum ada data titik lokasi sebaran siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet Assets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set view centered on Morotai
            const map = L.map('admin-map').setView([1.8845, 128.3649], 10);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Fetch and plot markers
            const locations = @json($locations);
            
            if (locations.length > 0) {
                const markerGroup = L.featureGroup();
                
                locations.forEach(loc => {
                    const total = parseInt(loc.male_count) + parseInt(loc.female_count);
                    
                    const popupContent = `
                        <div class="p-2 font-sans" style="min-width: 180px;">
                            <div class="border-b pb-1 mb-2">
                                <h6 class="font-bold text-gray-900 m-0" style="font-size: 14px;">${loc.name}</h6>
                                <span class="text-gray-400 text-xs">${loc.description || ''}</span>
                            </div>
                            <div class="space-y-1 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-gray-500"><i class="bi bi-people-fill me-1"></i> Total Siswa:</span>
                                    <strong class="text-gray-900">${total}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-600"><i class="bi bi-gender-male me-1"></i> Laki-laki:</span>
                                    <strong class="text-blue-600">${loc.male_count}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-pink-600"><i class="bi bi-gender-female me-1"></i> Perempuan:</span>
                                    <strong class="text-pink-600">${loc.female_count}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-emerald-600"><i class="bi bi-check-circle me-1"></i> Aktif:</span>
                                    <strong class="text-emerald-600">${loc.active_count}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-purple-600"><i class="bi bi-award me-1"></i> Alumni:</span>
                                    <strong class="text-purple-600">${loc.alumni_count}</strong>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    const marker = L.marker([loc.latitude, loc.longitude])
                        .bindPopup(popupContent)
                        .addTo(markerGroup);
                });
                
                markerGroup.addTo(map);
                map.fitBounds(markerGroup.getBounds().pad(0.1));
            }
        });

        // SweetAlert Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data titik lokasi ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('.delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-admin-layout>
