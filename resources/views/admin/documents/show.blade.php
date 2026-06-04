@extends('layouts.admin')

@section('header','Detail Dokumen')

@section('content')
    <div class="flex items-center gap-3 mb-4">
        <a href="{{ route('admin.documents.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="glass-card rounded-xl p-4 md:p-6">
        <div class="flex items-start justify-between gap-6 flex-wrap">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $doc->title }}</h3>
                @if($doc->description)
                    <p class="text-gray-600 mt-2">{{ $doc->description }}</p>
                @endif
            </div>
            <div class="flex items-center gap-2">
                @if($doc->active)
                    <span class="px-3 py-1 rounded bg-green-50 text-green-700 font-bold text-sm">Aktif</span>
                @else
                    <span class="px-3 py-1 rounded bg-gray-100 text-gray-700 font-bold text-sm">Nonaktif</span>
                @endif

                @if($doc->requires_validation)
                    <span class="px-3 py-1 rounded bg-blue-50 text-blue-700 font-bold text-sm">Perlu Validasi</span>
                @else
                    <span class="px-3 py-1 rounded bg-emerald-50 text-emerald-700 font-bold text-sm">Langsung</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">File</div>
                <div class="mt-2 font-bold text-gray-800">{{ $doc->file_name ?? basename($doc->file_path) }}</div>
                <div class="text-sm text-gray-600">Tipe: {{ strtoupper($doc->file_type) }}</div>
            </div>
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Unduhan</div>
                <div class="mt-2 font-bold text-gray-800 text-3xl">{{ $doc->download_total }}</div>
                <a href="{{ route('admin.documents.downloads', $doc) }}" class="text-blue-700 font-bold hover:underline">Lihat History</a>
            </div>
        </div>

        @if($doc->requires_validation)
            <div class="mt-6">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Validation Fields</div>
                <pre class="mt-2 bg-gray-100 p-4 rounded-xl overflow-x-auto text-sm text-gray-800">{{ json_encode($doc->validation_fields_json ?? [], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) }}</pre>
            </div>
        @endif

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('admin.documents.edit', $doc) }}" class="px-4 py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold rounded-lg">Edit</a>
            <a href="{{ route('admin.documents.downloads', $doc) }}" class="px-4 py-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-800 font-semibold rounded-lg">History</a>
        </div>
    </div>
@endsection

