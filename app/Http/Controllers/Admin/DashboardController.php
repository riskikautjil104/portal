<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\{Announcement, Student, Teacher, Room, News, PortalLink, User};

class DashboardController
{
    public function index(): View
    {
        $stats = [
            'announcements' => Announcement::count(),
            'news' => News::count(),
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'rooms' => Room::count(),
            'portal_links' => PortalLink::count(),
            'admins' => User::where('role', 'admin')->count(),
            'humas' => User::where('role', 'humas')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
