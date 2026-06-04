<?php

namespace App\Http\Controllers\Admin;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function index()
    {
        $sambutan = SchoolProfile::where('key_name', 'sambutan_kepsek')->first();
        $struktur = SchoolProfile::where('key_name', 'struktur_organisasi')->first();
        $fotoKepsek = SchoolProfile::where('key_name', 'foto_kepsek')->first();
        $visi = SchoolProfile::where('key_name', 'visi')->first();
        $misi = SchoolProfile::where('key_name', 'misi')->first();
        $sejarah = SchoolProfile::where('key_name', 'sejarah')->first();

        return view('admin.school_profile.index', compact(
            'sambutan', 'struktur', 'fotoKepsek', 'visi', 'misi', 'sejarah'
        ));
    }

    public function updateSambutan(Request $request)
    {
        $request->validate([
            'sambutan' => 'required|string',
        ]);

        SchoolProfile::updateOrCreate(
            ['key_name' => 'sambutan_kepsek'],
            ['value' => $request->sambutan]
        );

        return redirect()->route('admin.school-profile.index')->with('success', 'Sambutan Kepala Sekolah berhasil diperbarui!');
    }

    public function updateStruktur(Request $request)
    {
        $request->validate([
            'struktur' => 'required|image|max:5120',
        ]);

        if ($request->hasFile('struktur')) {
            $struktur = SchoolProfile::where('key_name', 'struktur_organisasi')->first();
            if ($struktur && $struktur->value) {
                Storage::disk('public')->delete($struktur->value);
            }
            
            $path = $request->file('struktur')->store('profiles', 'public');
            
            SchoolProfile::updateOrCreate(
                ['key_name' => 'struktur_organisasi'],
                ['value' => $path]
            );
        }

        return redirect()->route('admin.school-profile.index')->with('success', 'Struktur Organisasi berhasil diperbarui!');
    }

    public function updateFotoKepsek(Request $request)
    {
        $request->validate([
            'foto_kepsek' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('foto_kepsek')) {
            $foto = SchoolProfile::where('key_name', 'foto_kepsek')->first();
            if ($foto && $foto->value) {
                Storage::disk('public')->delete($foto->value);
            }
            
            $path = $request->file('foto_kepsek')->store('profiles', 'public');
            
            SchoolProfile::updateOrCreate(
                ['key_name' => 'foto_kepsek'],
                ['value' => $path]
            );
        }

        return redirect()->route('admin.school-profile.index')->with('success', 'Foto Kepala Sekolah berhasil diperbarui!');
    }

    public function updateVisiMisiSejarah(Request $request)
    {
        $request->validate([
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'sejarah' => 'nullable|string',
        ]);

        SchoolProfile::updateOrCreate(
            ['key_name' => 'visi'],
            ['value' => $request->visi]
        );

        SchoolProfile::updateOrCreate(
            ['key_name' => 'misi'],
            ['value' => $request->misi]
        );

        SchoolProfile::updateOrCreate(
            ['key_name' => 'sejarah'],
            ['value' => $request->sejarah]
        );

        return redirect()->route('admin.school-profile.index')->with('success', 'Visi, Misi, dan Sejarah Sekolah berhasil diperbarui!');
    }
}
