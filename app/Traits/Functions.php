<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;

trait Functions {
    public function sendMail($user,$mailable) {
        Mail::to($user->email)->send($mailable);
    }
}