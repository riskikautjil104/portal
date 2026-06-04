<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($announcement) ? 'Edit Pengumuman' : 'Buat Pengumuman' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($announcement) ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ isset($announcement) ? method_field('PUT') : '' }}

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                        <input type="text" name="title" value="{{ $announcement->title ?? '' }}" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-2 border rounded-lg" required>
                            <option value="umum" {{ (isset($announcement) && $announcement->category == 'umum') ? 'selected' : '' }}>Umum</option>
                            <option value="akademik" {{ (isset($announcement) && $announcement->category == 'akademik') ? 'selected' : '' }}>Akademik</option>
                            <option value="beasiswa" {{ (isset($announcement) && $announcement->category == 'beasiswa') ? 'selected' : '' }}>Beasiswa</option>
                            <option value="kegiatan" {{ (isset($announcement) && $announcement->category == 'kegiatan') ? 'selected' : '' }}>Kegiatan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Konten</label>
                        <textarea name="content" class="wysiwyg-editor w-full px-4 py-2 border rounded-lg">{{ $announcement->content ?? '' }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border rounded-lg" required>
                            <option value="draft" {{ (isset($announcement) && $announcement->status == 'draft') ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ (isset($announcement) && $announcement->status == 'published') ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ (isset($announcement) && $announcement->status == 'archived') ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                        <a href="{{ route('admin.announcements.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
