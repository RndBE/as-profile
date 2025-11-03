<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::send('User.emails.contact', ['data' => $validated], function ($mail) use ($validated) {
            $mail->to('as@be-jogja.com')
                ->subject('Contact Form: ' . $validated['subject'])
                ->replyTo($validated['email'], $validated['name']);
        });

        // Jika request dari AJAX (fetch)
        if ($request->ajax()) {
            return response('OK', 200);
        }

        // Jika dari form biasa
        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih!');
    }

}
