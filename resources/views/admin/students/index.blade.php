<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👨‍🎓 Kelola Data Siswa
            </h2>
            <a href="{{ route('admin.students.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-150">
                + Tambah Siswa
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
                                <th class="px-6 py-4">Foto</th>
                                <th class="px-6 py-4">Nama Lengkap</th>
                                <th class="px-6 py-4">NISN</th>
                                <th class="px-6 py-4">Kelas</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">JK</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($students as $student)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-blue-100 shadow-sm">
                                        @if($student->photo)
                                            <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $student->name }}
                                </td>
                                <td class="px-6 py-4 font-mono text-gray-600">
                                    {{ $student->nisn ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    <span class="px-3 py-1 text-xs font-semibold bg-blue-50 text-blue-700 rounded-lg">
                                        {{ $student->class_name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($student->active)
                                        <span class="px-3 py-1 text-xs font-semibold bg-green-50 text-green-700 rounded-lg">Aktif</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold bg-gray-50 text-gray-600 rounded-lg">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold bg-indigo-50 text-indigo-700 rounded-lg">
                                        {{ $student->gender ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.students.edit', $student) }}" class="px-3 py-1.5 bg-yellow-100 text-yellow-800 hover:bg-yellow-200 rounded-lg transition duration-150 flex items-center gap-1 font-medium">
                                            <i class="ph ph-pencil-simple"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="delete-form">
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
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 font-medium">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $students->links() }}
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
                        text: "Data siswa ini akan dihapus secara permanen!",
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
