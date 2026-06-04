<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🏫 Kelola Ruangan & Fasilitas
            </h2>
            <a href="{{ route('admin.rooms.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-150">
                + Tambah Ruangan
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4">Foto Ruangan</th>
                                <th class="px-6 py-4">Nama Ruangan</th>
                                <th class="px-6 py-4">Tipe Ruangan</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($rooms as $room)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="w-24 h-16 rounded-lg overflow-hidden border border-blue-50 shadow-sm">
                                        @if($room->photo)
                                            <img src="{{ asset('storage/' . $room->photo) }}" alt="{{ $room->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold">
                                                <i class="ph ph-image text-3xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $room->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($room->type === 'class') bg-blue-100 text-blue-800
                                        @elseif($room->type === 'lab') bg-indigo-100 text-indigo-800
                                        @else bg-green-100 text-green-800
                                        @endif">
                                        @if($room->type === 'class') Kelas
                                        @elseif($room->type === 'lab') Laboratorium
                                        @else Fasilitas Umum
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.rooms.edit', $room) }}" class="px-3 py-1.5 bg-yellow-100 text-yellow-800 hover:bg-yellow-200 rounded-lg transition duration-150 flex items-center gap-1 font-medium">
                                            <i class="ph ph-pencil-simple"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="px-3 py-1.5 bg-red-100 text-red-800 hover:bg-red-200 rounded-lg transition duration-150 flex items-center gap-1 font-medium delete-btn">
                                                <i class="ph ph-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">
                                    Belum ada data ruangan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ruangan ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DC3545',
                        cancelButtonColor: '#6C757D',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-admin-layout>
