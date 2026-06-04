<?php

namespace App\Http\Controllers\Public;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentsController
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $class = trim((string) $request->query('class', ''));
        $active = trim((string) $request->query('active', ''));

        $query = Student::query();

        if ($q !== '') {
            $query->where('name', 'like', '%' . $q . '%');
        }

        if ($class !== '') {
            $query->where('class_name', $class);
        }

        // active: true/false
        if ($active === '1') {
            $query->where('active', true);
        } elseif ($active === '0') {
            $query->where('active', false);
        }

        $students = $query
            ->orderBy('class_name')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $classes = Student::query()
            ->select('class_name')
            ->whereNotNull('class_name')
            ->where('class_name', '!=', '')
            ->distinct()
            ->orderBy('class_name')
            ->pluck('class_name');

        // Summary
        $base = clone $query;
        $summary = [
            'active_count' => (clone $base)->where('active', true)->count(),
            'inactive_count' => (clone $base)->where('active', false)->count(),
            'male_count' => (clone $base)->where('gender', 'L')->count(),
            'female_count' => (clone $base)->where('gender', 'P')->count(),
        ];

        // Alumni / per kelas
        // NOTE: MySQL ONLY_FULL_GROUP_BY aktif, jadi jangan orderBy kolom non-agregat.
        $byClass = Student::query()
            // ikut filter yang sedang dipakai
            ->when($q !== '', fn($q2) => $q2->where('name', 'like', '%' . $q . '%'))
            ->when($class !== '', fn($q2) => $q2->where('class_name', $class))
            ->when($active === '1', fn($q2) => $q2->where('active', true))
            ->when($active === '0', fn($q2) => $q2->where('active', false))
            ->selectRaw('class_name, active, gender, COUNT(*) as total')
            ->groupBy('class_name', 'active', 'gender')
            ->get();

        return view('public.students.index', compact('students', 'classes', 'q', 'class', 'active', 'summary', 'byClass'));
    }
}

