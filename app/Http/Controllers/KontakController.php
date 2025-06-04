<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class KontakController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        // Kirim email (pastikan konfigurasi mail sudah benar di .env)
        Mail::to('rektorat@bsi.ac.id')->send(new ContactFormMail($validated));

        return back()->with('success', 'Pesan Anda telah terkirim!');
    }
}
