<?php

namespace App\Http\Controllers\Public;

use App\Models\Banner;
use App\Models\Announcement;
use App\Models\News;
use App\Models\PortalLink;
use App\Models\SchoolProfile;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\View\View;


class HomeController
{
    public function index(): View
    {
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        $announcements = Announcement::where('status', 'published')->latest()->take(3)->get();
        $news = News::where('status', 'published')->latest()->take(3)->get();
        $portalLinks = PortalLink::where('active', true)->orderBy('order')->get();
        $sambutan = SchoolProfile::where('key_name', 'sambutan_kepsek')->first();
        $fotoKepsek = SchoolProfile::where('key_name', 'foto_kepsek')->first();
        $teachers = Teacher::orderBy('name')->get();

        $studentsActiveCount = Student::where('active', true)->count();
        $studentsActiveMaleCount = Student::where('active', true)->where('gender', 'L')->count();
        $studentsActiveFemaleCount = Student::where('active', true)->where('gender', 'P')->count();

        return view('public.home', compact(
            'banners',
            'announcements',
            'news',
            'portalLinks',
            'sambutan',
            'fotoKepsek',
            'teachers',
            'studentsActiveCount',
            'studentsActiveMaleCount',
            'studentsActiveFemaleCount'
        ));


    }
}

