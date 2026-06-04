@extends('layouts.admin')

@section('header','History Unduhan')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-xl font-bold text-gray-800">{{ $doc->title }}</h3>
            <p class="text-sm text-gray-500">Riwayat unduhan dokumen dan status validasi.</p>
        </div>
        <a href="{{ route('admin.documents.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Kembali</a>
    </div>

    <div class="glass-card rounded-xl p-4 md:p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b border-gray-100">
                        <th class="py-3 px-2 font-semibold">Waktu</th>
                        <th class="py-3 px-2 font-semibold">Nama</th>
                        <th class="py-3 px-2 font-semibold">Email</th>
                        <th class="py-3 px-2 font-semibold">Instansi</th>
                        <th class="py-3 px-2 font-semibold">Status Validasi</th>
                        <th class="py-3 px-2 font-semibold text-right">IP</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($downloads as $d)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-4 px-2">{{ $d->created_at?->format('d M Y H:i') }}</td>
                        <td class="py-4 px-2 font-bold text-gray-800">{{ $d->full_name ?? '-' }}</td>
                        <td class="py-4 px-2">{{ $d->email ?? '-' }}</td>
                        <td class="py-4 px-2">{{ $d->institution ?? '-' }}</td>
                        <td class="py-4 px-2">
                            @if($d->validation_id)
                                <span class="px-2 py-1 rounded bg-blue-50 text-blue-700 font-bold">Completed</span>
                            @else
                                <span class="px-2 py-1 rounded bg-emerald-50 text-emerald-700 font-bold">Direct</span>
                            @endif
                        </td>
                        <td class="py-4 px-2 text-right font-mono text-gray-700">{{ $d->ip ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-10 text-center text-gray-500">Belum ada history download.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $downloads->links() }}</div>
    </div>
@endsection

