<?php

namespace App\Http\Controllers\Admin;

use App\Models\StudentLocation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class StudentMapController extends Controller
{
    public function index(): View
    {
        $locations = StudentLocation::all();
        return view('admin.map.index', compact('locations'));
    }

    public function create(): View
    {
        return view('admin.map.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string',
            'male_count' => 'required|integer|min:0',
            'female_count' => 'required|integer|min:0',
            'active_count' => 'required|integer|min:0',
            'alumni_count' => 'required|integer|min:0',
        ]);

        StudentLocation::create($request->all());

        return redirect()->route('admin.map.index')->with('success', 'Titik lokasi siswa berhasil ditambahkan!');
    }

    public function edit(StudentLocation $peta_siswa): View
    {
        // Route model binding automatically binds $peta_siswa, but since resource name is peta-siswa, parameter is peta_siswa.
        $location = $peta_siswa;
        return view('admin.map.edit', compact('location'));
    }

    public function update(Request $request, StudentLocation $peta_siswa): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string',
            'male_count' => 'required|integer|min:0',
            'female_count' => 'required|integer|min:0',
            'active_count' => 'required|integer|min:0',
            'alumni_count' => 'required|integer|min:0',
        ]);

        $peta_siswa->update($request->all());

        return redirect()->route('admin.map.index')->with('success', 'Titik lokasi siswa berhasil diperbarui!');
    }

    public function destroy(StudentLocation $peta_siswa): RedirectResponse
    {
        $peta_siswa->delete();

        return redirect()->route('admin.map.index')->with('success', 'Titik lokasi siswa berhasil dihapus!');
    }

    public function getData(): JsonResponse
    {
        $locations = StudentLocation::all();
        return response()->json($locations);
    }
}
