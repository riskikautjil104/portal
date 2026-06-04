<?php

namespace App\Http\Controllers\Public;

use App\Models\Announcement;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class AnnouncementController
{
    public function index(): View
    {
        $announcements = Announcement::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('public.announcements.index', compact('announcements'));
    }

    public function show(string $encryptedAnnouncement): View
    {
        try {
            $id = Crypt::decryptString($encryptedAnnouncement);
        } catch (DecryptException) {
            abort(404);
        }

        $announcement = Announcement::where('id', $id)
            ->where('status', 'published')
            ->firstOrFail();

        return view('public.announcements.show', compact('announcement'));
    }
}
