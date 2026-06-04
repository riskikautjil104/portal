@extends('layouts.admin')

@section('header','Edit Dokumen')

@section('content')
    <div class="flex items-center gap-3 mb-4">
        <a href="{{ route('admin.documents.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="glass-card rounded-xl p-4 md:p-6">
        <form action="{{ route('admin.documents.update', $doc) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Dokumen</label>
                    <input type="text" name="title" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100" value="{{ $doc->title }}" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100">{{ $doc->description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">File Tipe</label>
                    <input type="text" name="file_type" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100" value="{{ $doc->file_type }}" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Aktif</label>
                    <select name="active" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100">
                        <option value="1" @selected($doc->active)>Aktif</option>
                        <option value="0" @selected(!$doc->active)>Nonaktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti File (opsional)</label>
                    <input type="file" name="file" class="w-full">
                    @if($doc->file_path)
                        <div class="text-xs text-gray-500 mt-2">File saat ini: <span class="font-semibold">{{ $doc->file_name ?? basename($doc->file_path) }}</span></div>
                    @endif
                </div>
            </div>

            <hr class="my-6 border-gray-100">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Butuh Validasi</label>
                    <select name="requires_validation" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100">
                        <option value="0" @selected(!$doc->requires_validation)>Tidak</option>
                        <option value="1" @selected($doc->requires_validation>0)>Ya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">validation_fields_json</label>
                    <input type="text" name="validation_fields_json" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100" value='{{ json_encode($doc->validation_fields_json ?? [], JSON_UNESCAPED_SLASHES) }}'>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.documents.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition duration-150">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 flex items-center gap-2">
                    <i class="bi bi-save"></i> Update
                </button>
            </div>
        </form>
    </div>
@endsection

