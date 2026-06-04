<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.news.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="ph ph-arrow-left text-xl"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📰 Edit Berita Sekolah
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Title Field -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Berita <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition font-medium text-lg" placeholder="Masukkan judul berita..." required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image Upload and Preview -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto / Gambar Utama</label>
                            
                            <div class="w-full aspect-[21/9] rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-center relative group">
                                @if($news->image)
                                    <img id="photo-preview" src="{{ asset('storage/' . $news->image) }}" class="w-full h-full object-cover">
                                    <div id="photo-placeholder" class="text-center p-4 hidden">
                                        <i class="ph ph-image text-6xl text-gray-300"></i>
                                        <p class="text-xs text-gray-400 mt-1">Pilih Gambar Utama Berita</p>
                                    </div>
                                @else
                                    <img id="photo-preview" class="w-full h-full object-cover hidden">
                                    <div id="photo-placeholder" class="text-center p-4">
                                        <i class="ph ph-image text-6xl text-gray-300"></i>
                                        <p class="text-xs text-gray-400 mt-1">Pilih Gambar Utama Berita</p>
                                    </div>
                                @endif
                            </div>
                            
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                            <div class="flex justify-center mt-3">
                                <button type="button" onclick="document.getElementById('image').click()" class="px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-sm rounded-lg transition duration-150 border border-blue-200">
                                    Ubah Gambar
                                </button>
                            </div>
                            
                            @error('image')
                                <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Field -->
                        <div class="w-full md:w-1/3">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status Publikasi <span class="text-red-500">*</span></label>
                            <select name="status" id="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                                <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Publikasikan (Published)</option>
                                <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content Field with TinyMCE (Wysiwyg) -->
                        <div>
                            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita <span class="text-red-500">*</span></label>
                            <textarea name="content" id="content" class="wysiwyg-editor w-full px-4 py-2 border rounded-lg">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition duration-150">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-admin-layout>
