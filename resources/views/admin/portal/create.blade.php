<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($portalLink) ? 'Edit Portal Link' : 'Tambah Portal Link' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($portalLink) ? route('admin.portal-links.update', $portalLink) : route('admin.portal-links.store') }}" method="POST">
                    @csrf
                    {{ isset($portalLink) ? method_field('PUT') : '' }}

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Nama Link</label>
                        <input type="text" name="name" value="{{ $portalLink->name ?? '' }}" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">URL</label>
                        <input type="url" name="url" value="{{ $portalLink->url ?? '' }}" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg" required>{{ $portalLink->description ?? '' }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Icon (Emoji)</label>
                        <input type="text" name="icon" value="{{ $portalLink->icon ?? '' }}" class="w-full px-4 py-2 border rounded-lg" placeholder="e.g., 📚">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Urutan</label>
                        <input type="number" name="order" value="{{ $portalLink->order ?? 1 }}" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="active" value="1" {{ (isset($portalLink) && $portalLink->active) ? 'checked' : '' }} class="rounded">
                            <span class="ml-2">Aktif</span>
                        </label>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                        <a href="{{ route('admin.portal-links.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
