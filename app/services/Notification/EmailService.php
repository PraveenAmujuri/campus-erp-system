<?php

namespace App\Services\Notification;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send(
        $to,
        $subject,
        $message
    ) {

        Mail::raw($message, function ($mail)
        use ($to, $subject) {

            $mail->to($to)
                 ->subject($subject);

        });
    }
}