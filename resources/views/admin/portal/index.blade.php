<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🔗 Kelola Portal Links
            </h2>
            <a href="{{ route('admin.portal-links.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Tambah Link
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama</th>
                            <th class="px-6 py-3 text-left">URL</th>
                            <th class="px-6 py-3 text-left">Aktif</th>
                            <th class="px-6 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-6 py-3">SIMORO</td>
                            <td class="px-6 py-3">https://simoro.sman5morotai.sch.id</td>
                            <td class="px-6 py-3"><span class="px-2 py-1 bg-green-100 text-green-800 rounded">✓ Aktif</span></td>
                            <td class="px-6 py-3">
                                <a href="#" class="text-blue-600 mr-3">Edit</a>
                                <a href="#" class="text-red-600">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
