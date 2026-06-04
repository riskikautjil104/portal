<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.banners.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="ph ph-arrow-left text-xl"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🖼️ Edit Banner Carousel
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Banner Image Upload & Preview -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Banner</label>
                            
                            <div class="w-full aspect-[21/9] rounded-lg overflow-hidden border-4 border-blue-50 shadow-md bg-gray-50 flex items-center justify-center relative group">
                                @if($banner->image)
                                    <img id="photo-preview" src="{{ asset('storage/' . $banner->image) }}" class="w-full h-full object-cover">
                                    <div id="photo-placeholder" class="text-center p-4 hidden">
                                        <i class="ph ph-image text-7xl text-gray-300"></i>
                                        <p class="text-sm text-gray-400 mt-1">Pilih Gambar Banner (Disarankan Rasio 21:9 atau Resolusi 1920x820)</p>
                                    </div>
                                @else
                                    <img id="photo-preview" class="w-full h-full object-cover hidden">
                                    <div id="photo-placeholder" class="text-center p-4">
                                        <i class="ph ph-image text-7xl text-gray-300"></i>
                                        <p class="text-sm text-gray-400 mt-1">Pilih Gambar Banner (Disarankan Rasio 21:9 atau Resolusi 1920x820)</p>
                                    </div>
                                @endif
                            </div>
                            
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                            <div class="flex justify-center mt-4">
                                <button type="button" onclick="document.getElementById('image').click()" class="px-5 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-sm rounded-lg transition duration-150 border border-blue-200">
                                    Ubah Gambar
                                </button>
                            </div>
                            
                            @error('image')
                                <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-400 mt-2 text-center">Format: JPG, JPEG, PNG, WEBP. Maks 5MB.</p>
                        </div>

                        <!-- Info Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Banner (Opsional)</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Contoh: Selamat Datang di SMAN 5 Morotai">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-1">Sub-judul Banner (Opsional)</label>
                                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Contoh: Unggul dalam IPTEK, Kokoh dalam IMTAK">
                                @error('subtitle')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampilan</label>
                                <input type="number" name="order" id="order" value="{{ old('order', $banner->order) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Contoh: 1">
                                @error('order')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="is_active" class="block text-sm font-semibold text-gray-700 mb-1">Status Banner</label>
                                <select name="is_active" id="is_active" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="1" {{ old('is_active', $banner->is_active) == '1' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                                    <option value="0" {{ old('is_active', $banner->is_active) == '0' ? 'selected' : '' }}>Nonaktif (Sembunyikan)</option>
                                </select>
                                @error('is_active')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('admin.banners.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition duration-150">
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
