<?php

namespace App\Services\Notification;

use App\Models\Notification;

class NotificationService
{
    protected $emailService;

    public function __construct(
        EmailService $emailService
    ) {
        $this->emailService = $emailService;
    }

    /**
     * Send Email Notification
     */
    public function sendEmail(array $data)
    {
        $this->emailService->send(

            $data['recipient'],

            $data['title'] ?? 'Campus ERP Notification',

            $data['message']
        );

        return Notification::create([

            'user_id' => $data['user_id'] ?? null,

            'type' => 'EMAIL',

            'title' => $data['title'] ?? null,

            'message' => $data['message'],

            'recipient' => $data['recipient'],

            'status' => 'SENT',

            'sent_at' => now()
        ]);
    }

    /**
     * Simulated SMS Notification
     */
    public function sendSms(array $data)
    {
        return Notification::create([

            'user_id' => $data['user_id'] ?? null,

            'type' => 'SMS',

            'title' => $data['title'] ?? null,

            'message' => $data['message'],

            'recipient' => $data['recipient'],

            'status' => 'SENT',

            'sent_at' => now()
        ]);
    }

    /**
     * Simulated WhatsApp Notification
     */
    public function sendWhatsapp(array $data)
    {
        return Notification::create([

            'user_id' => $data['user_id'] ?? null,

            'type' => 'WHATSAPP',

            'title' => $data['title'] ?? null,

            'message' => $data['message'],

            'recipient' => $data['recipient'],

            'status' => 'SENT',

            'sent_at' => now()
        ]);
    }
}