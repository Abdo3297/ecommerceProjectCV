<?php

namespace App\Mail\Auth\Admin;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResendOTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $opt;

    public function __construct($user)
    {
        $this->user = $user;
        $this->opt = $this->generateOtp();
    }

    private function generateOtp()
    {
        return (new Otp)->generate($this->user->email, NUMERIC, LENGTH, VALIDITY)->token;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resend OTP Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.auth.admin.resend',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
