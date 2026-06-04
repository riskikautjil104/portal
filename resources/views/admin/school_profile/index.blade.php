<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <i class="bi bi-building-gear text-2xl text-blue-600"></i>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pengaturan Profil Sekolah
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Section: Sambutan, Visi, Misi, Sejarah (Takes 2 cols) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Sambutan Kepala Sekolah -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                                <i class="bi bi-chat-left-text"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Sambutan Kepala Sekolah</h3>
                                <p class="text-xs text-gray-500">Teks ini akan ditampilkan di halaman utama dan profil sekolah.</p>
                            </div>
                        </div>

                        <form action="{{ route('admin.school-profile.sambutan') }}" method="POST">
                            @csrf
                            
                            <div class="space-y-4">
                                <div>
                                    <textarea name="sambutan" class="wysiwyg-editor w-full px-4 py-2 border rounded-lg" rows="12">{{ old('sambutan', $sambutan->value ?? '') }}</textarea>
                                    @error('sambutan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 flex items-center gap-2">
                                        <i class="bi bi-floppy"></i> Simpan Sambutan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Visi, Misi & Sejarah Sekolah -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Visi, Misi & Sejarah Sekolah</h3>
                                <p class="text-xs text-gray-500">Kelola visi, misi, dan narasi sejarah sekolah.</p>
                            </div>
                        </div>

                        <form action="{{ route('admin.school-profile.visi-misi-sejarah') }}" method="POST">
                            @csrf
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Visi Sekolah</label>
                                    <textarea name="visi" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" rows="3">{{ old('visi', $visi->value ?? '') }}</textarea>
                                    @error('visi')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Misi Sekolah</label>
                                    <textarea name="misi" class="wysiwyg-editor w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" rows="8">{{ old('misi', $misi->value ?? '') }}</textarea>
                                    @error('misi')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Sejarah Sekolah</label>
                                    <textarea name="sejarah" class="wysiwyg-editor w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" rows="8">{{ old('sejarah', $sejarah->value ?? '') }}</textarea>
                                    @error('sejarah')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end pt-4 border-t border-gray-100">
                                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 flex items-center gap-2">
                                        <i class="bi bi-floppy"></i> Simpan Visi, Misi & Sejarah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Section: Foto Kepsek & Struktur Organisasi (Takes 1 col) -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Foto Kepala Sekolah -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Foto Kepala Sekolah</h3>
                                <p class="text-xs text-gray-500">Unggah foto resmi Kepala Sekolah.</p>
                            </div>
                        </div>

                        <form action="{{ route('admin.school-profile.foto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="space-y-5">
                                <div>
                                    <div class="w-full aspect-square rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-center relative group">
                                        @if($fotoKepsek && $fotoKepsek->value)
                                            <img id="foto-preview" src="{{ asset('storage/' . $fotoKepsek->value) }}" class="w-full h-full object-cover">
                                            <div id="foto-placeholder" class="text-center p-4 hidden">
                                                <i class="bi bi-person-fill text-6xl text-gray-300"></i>
                                                <p class="text-xs text-gray-400 mt-1">Pilih Foto Kepala Sekolah</p>
                                            </div>
                                        @else
                                            <img id="foto-preview" class="w-full h-full object-cover hidden">
                                            <div id="foto-placeholder" class="text-center p-4">
                                                <i class="bi bi-person-fill text-6xl text-gray-300"></i>
                                                <p class="text-xs text-gray-400 mt-1">Pilih Foto Kepala Sekolah</p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <input type="file" name="foto_kepsek" id="foto_kepsek" class="hidden" accept="image/*" onchange="previewFoto(event)">
                                    <div class="flex justify-center mt-4">
                                        <button type="button" onclick="document.getElementById('foto_kepsek').click()" class="px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-sm rounded-lg transition duration-150 border border-blue-200">
                                            Pilih Foto
                                        </button>
                                    </div>
                                    
                                    @error('foto_kepsek')
                                        <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-4 border-t border-gray-100 flex justify-end">
                                    <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 flex items-center justify-center gap-2">
                                        <i class="bi bi-cloud-arrow-up"></i> Unggah Foto Baru
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Struktur Organisasi -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg glass-card p-8">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center text-xl">
                                <i class="bi bi-diagram-3"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Struktur Organisasi</h3>
                                <p class="text-xs text-gray-500">Unggah bagan organisasi sekolah.</p>
                            </div>
                        </div>

                        <form action="{{ route('admin.school-profile.struktur') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="space-y-5">
                                <div>
                                    <div class="w-full aspect-[3/4] rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-center relative group">
                                        @if($struktur && $struktur->value)
                                            <img id="struktur-preview" src="{{ asset('storage/' . $struktur->value) }}" class="w-full h-full object-cover">
                                            <div id="struktur-placeholder" class="text-center p-4 hidden">
                                                <i class="bi bi-image text-6xl text-gray-300"></i>
                                                <p class="text-xs text-gray-400 mt-1">Pilih Bagan Organisasi</p>
                                            </div>
                                        @else
                                            <img id="struktur-preview" class="w-full h-full object-cover hidden">
                                            <div id="struktur-placeholder" class="text-center p-4">
                                                <i class="bi bi-image text-6xl text-gray-300"></i>
                                                <p class="text-xs text-gray-400 mt-1">Pilih Bagan Organisasi</p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <input type="file" name="struktur" id="struktur" class="hidden" accept="image/*" onchange="previewStruktur(event)">
                                    <div class="flex justify-center mt-4">
                                        <button type="button" onclick="document.getElementById('struktur').click()" class="px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-sm rounded-lg transition duration-150 border border-blue-200">
                                            Ubah Bagan
                                        </button>
                                    </div>
                                    
                                    @error('struktur')
                                        <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-4 border-t border-gray-100 flex justify-end">
                                    <button type="submit" class="w-full py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-sm transition duration-150 flex items-center justify-center gap-2">
                                        <i class="bi bi-cloud-arrow-up"></i> Unggah Bagan Baru
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function previewStruktur(event) {
            const input = event.target;
            const preview = document.getElementById('struktur-preview');
            const placeholder = document.getElementById('struktur-placeholder');
            
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

        function previewFoto(event) {
            const input = event.target;
            const preview = document.getElementById('foto-preview');
            const placeholder = document.getElementById('foto-placeholder');
            
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
