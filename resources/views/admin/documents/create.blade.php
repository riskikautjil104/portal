@extends('layouts.admin')

@section('header','Tambah Dokumen')

@section('content')
    <div class="flex items-center gap-3 mb-4">
        <a href="{{ route('admin.documents.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="glass-card rounded-xl p-4 md:p-6">
        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Dokumen</label>
                    <input type="text" name="title" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100" value="{{ old('title') }}" required>
                    @error('title')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">File Tipe (pdf/word/excel/image/lainnya)</label>
                    <input type="text" name="file_type" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100" value="{{ old('file_type','pdf') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Aktif</label>
                    <select name="active" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100">
                        <option value="1" @selected(old('active',true))>Aktif</option>
                        <option value="0" @selected(old('active',false)==false && old('active')==='0')>Nonaktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Upload File</label>
                    <input type="file" name="file" class="w-full">
                    @error('file')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr class="my-6 border-gray-100">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Butuh Validasi</label>
                    <select name="requires_validation" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100" id="requires_validation">
                        <option value="0" @selected(old('requires_validation','0')==='0')>Tidak</option>
                        <option value="1" @selected(old('requires_validation','0')==='1')>Ya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Download Fields JSON (optional)</label>
                    <input type="text" name="validation_fields_json" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-100" placeholder='[{"name":"full_name","required":true,"label":"Nama"}]' value="{{ old('validation_fields_json','') }}">
                    <div class="text-xs text-gray-500 mt-2">Format JSON array, misal: <code class="text-gray-700">[{"name":"kualifikasi","required":true}]</code></div>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.documents.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition duration-150">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 flex items-center gap-2">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

