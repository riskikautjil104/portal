<?php

namespace App\Http\Controllers\Public;

use App\Models\ContactMessage;
use App\Mail\ContactMessageMail;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController
{
    public function index(): View
    {
        return view('public.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        try {
            $contact = ContactMessage::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message' => $validated['message'],
                'status' => 'unread',
            ]);

            $adminEmail = config('mail.from.address', 'noreply@sman5morotai.sch.id');
            Mail::to($adminEmail)->send(new ContactMessageMail(
                $validated['name'],
                $validated['email'],
                $validated['message']
            ));

            return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah dikirim.');
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.')->withInput();
        }
    }
}
