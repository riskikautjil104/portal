@extends('layouts.admin')

@section('header','Dokumen')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Daftar Dokumen</h3>
            <p class="text-sm text-gray-500">Kelola dokumen dan lihat kebutuhan validasinya.</p>
        </div>
        <a href="{{ route('admin.documents.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 flex items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Dokumen
        </a>
    </div>

    <div class="glass-card rounded-xl p-4 md:p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b border-gray-100">
                        <th class="py-3 px-2 font-semibold">Judul</th>
                        <th class="py-3 px-2 font-semibold">Tipe File</th>
                        <th class="py-3 px-2 font-semibold">Status</th>
                        <th class="py-3 px-2 font-semibold">Validasi</th>
                        <th class="py-3 px-2 font-semibold">Unduhan</th>
                        <th class="py-3 px-2 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-2">
                                <div class="font-bold text-gray-800">{{ $doc->title }}</div>
                                @if($doc->description)
                                    <div class="text-gray-500 truncate" style="max-width:420px">{{ $doc->description }}</div>
                                @endif
                            </td>
                            <td class="py-4 px-2">
                                <span class="px-2 py-1 rounded bg-gray-100 text-gray-700 font-semibold">{{ strtoupper($doc->file_type) }}</span>
                            </td>
                            <td class="py-4 px-2">
                                @if($doc->active)
                                    <span class="px-2 py-1 rounded bg-green-50 text-green-700 font-semibold">Aktif</span>
                                @else
                                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-700 font-semibold">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-4 px-2">
                                @if($doc->requires_validation)
                                    <span class="px-2 py-1 rounded bg-blue-50 text-blue-700 font-semibold">Perlu</span>
                                @else
                                    <span class="px-2 py-1 rounded bg-emerald-50 text-emerald-700 font-semibold">Tidak</span>
                                @endif
                            </td>
                            <td class="py-4 px-2 font-bold text-gray-800">{{ $doc->download_total }}</td>
                            <td class="py-4 px-2 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.documents.show', $doc) }}" class="px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition">Detail</a>
                                    <a href="{{ route('admin.documents.edit', $doc) }}" class="px-3 py-1.5 rounded-lg bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold transition">Edit</a>
                                    <a href="{{ route('admin.documents.downloads', $doc) }}" class="px-3 py-1.5 rounded-lg bg-indigo-100 hover:bg-indigo-200 text-indigo-800 font-semibold transition">History</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500">Belum ada dokumen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $documents->links() }}</div>
    </div>
@endsection

