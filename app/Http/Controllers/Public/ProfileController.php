<?php

namespace App\Http\Controllers\Public;

use App\Models\SchoolProfile;
use App\Models\Teacher;
use App\Models\Room;
use App\Models\Student;
use Illuminate\View\View;

class ProfileController
{
    public function index(): View
    {
        $sambutan = SchoolProfile::where('key_name', 'sambutan_kepsek')->first();
        $struktur = SchoolProfile::where('key_name', 'struktur_organisasi')->first();
        $fotoKepsek = SchoolProfile::where('key_name', 'foto_kepsek')->first();

        $teachers = Teacher::orderBy('name')->get();
        $rooms = Room::all();
        $studentsCount = Student::count();
        $classes = Student::select('class_name')
            ->selectRaw('count(*) as count')
            ->groupBy('class_name')
            ->orderBy('class_name')
            ->get();

        return view('public.profile', compact(
            'sambutan',
            'struktur',
            'fotoKepsek',
            'teachers',
            'rooms',
            'studentsCount',
            'classes'
        ));

    }
}
