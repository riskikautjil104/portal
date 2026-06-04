<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.students.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="ph ph-arrow-left text-xl"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👨‍🎓 Edit Data Siswa
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Left column: Photo Upload & Preview -->
                        <div class="md:col-span-1 flex flex-col items-center">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Siswa</label>
                            
                            <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-blue-50 shadow-md bg-gray-50 flex items-center justify-center relative group">
                                @if($student->photo)
                                    <img id="photo-preview" src="{{ asset('storage/' . $student->photo) }}" class="w-full h-full object-cover">
                                    <div id="photo-placeholder" class="text-center p-4 hidden">
                                        <i class="ph ph-user-circle text-6xl text-gray-300"></i>
                                        <p class="text-xs text-gray-400 mt-1">Pilih Foto</p>
                                    </div>
                                @else
                                    <img id="photo-preview" class="w-full h-full object-cover hidden">
                                    <div id="photo-placeholder" class="text-center p-4">
                                        <i class="ph ph-user-circle text-6xl text-gray-300"></i>
                                        <p class="text-xs text-gray-400 mt-1">Pilih Foto</p>
                                    </div>
                                @endif
                            </div>
                            
                            <input type="file" name="photo" id="photo" class="hidden" accept="image/*" onchange="previewImage(event)">
                            <button type="button" onclick="document.getElementById('photo').click()" class="mt-4 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-sm rounded-lg transition duration-150 border border-blue-200">
                                Ubah Foto
                            </button>
                            
                            @error('photo')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-400 mt-3 text-center">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                        </div>

                        <!-- Right column: Input fields -->
                        <div class="md:col-span-2 space-y-5">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Contoh: Rian Hidayat" required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nisn" class="block text-sm font-semibold text-gray-700 mb-1">NISN (Nomor Induk Siswa Nasional)</label>
                                <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $student->nisn) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Contoh: 0054832910">
                                @error('nisn')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="class_name" class="block text-sm font-semibold text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                                <input type="text" name="class_name" id="class_name" value="{{ old('class_name', $student->class_name) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Contoh: XII IPA 1 atau X-B" required>
                                @error('class_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                                        <span class="text-red-500">*</span> Siswa Aktif
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <input type="hidden" name="active" value="0">
                                        <input type="checkbox" name="active" value="1" id="active" class="w-4 h-4 text-blue-600"
                                            {{ old('active', $student->active) ? 'checked' : '' }}>
                                        <label for="active" class="text-sm text-gray-600">Centang jika aktif</label>
                                    </div>
                                    @error('active')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-semibold text-gray-700 mb-1">
                                        <span class="text-red-500">*</span> Jenis Kelamin
                                    </label>
                                    <select name="gender" id="gender" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                                        <option value="" disabled {{ old('gender', $student->gender) ? '' : 'selected' }}>Pilih...</option>
                                        <option value="L" {{ old('gender', $student->gender) === 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                                        <option value="P" {{ old('gender', $student->gender) === 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                                    </select>
                                    @error('gender')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('admin.students.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition duration-150">
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
