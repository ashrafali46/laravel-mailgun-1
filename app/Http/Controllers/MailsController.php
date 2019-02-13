<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailUsingMailgun;

class MailsController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function send(Request $request)
    {
        $to = $request->email;
        $content = $request->message;

        Mail::to($to)->send(new MailUsingMailgun(array('content' => $content)));

        if (Mail::failures()) {
            return redirect()
                ->back()
                ->with('error', 'Unable to send mail.');
        }

        return redirect()
            ->back()
            ->with('success', 'Mail sent.');
    }
}
