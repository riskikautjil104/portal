<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📢 Kelola Pengumuman
            </h2>
            <a href="{{ route('admin.announcements.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-150">
                + Buat Pengumuman
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
                                <th class="px-6 py-4">Judul</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Penulis</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal Rilis</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($announcements as $announcement)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $announcement->title }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($announcement->category === 'umum') bg-blue-100 text-blue-800
                                        @elseif($announcement->category === 'akademik') bg-purple-100 text-purple-800
                                        @elseif($announcement->category === 'beasiswa') bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($announcement->category) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $announcement->user->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($announcement->status === 'published') bg-green-100 text-green-800
                                        @elseif($announcement->status === 'draft') bg-gray-100 text-gray-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($announcement->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->isoFormat('D MMMM Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="px-3 py-1.5 bg-yellow-100 text-yellow-800 hover:bg-yellow-200 rounded-lg transition duration-150 flex items-center gap-1 font-medium">
                                            <i class="ph ph-pencil-simple"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="delete-form">
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
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 font-medium">
                                    Belum ada pengumuman yang dibuat.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $announcements->links() }}
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
                        text: "Data pengumuman ini akan dihapus secara permanen!",
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
