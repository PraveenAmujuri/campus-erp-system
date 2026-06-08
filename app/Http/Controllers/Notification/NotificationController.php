<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Services\Notification\NotificationService;
use App\Models\Notification;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(
        NotificationService $notificationService
    ) {
        $this->notificationService = $notificationService;
    }

    /**
     * Store Notification
     */
    public function store(
        StoreNotificationRequest $request
    ) {

        $recipients = explode(
            ',',
            $request->recipient
        );

        foreach ($recipients as $recipient) {

            $recipient = trim($recipient);

            $data = [

                'recipient' => $recipient,

                'title' => 'Campus ERP Notification',

                'message' => $request->message
            ];

            switch ($request->type) {

                case 'SMS':

                    $this->notificationService
                        ->sendSms($data);

                    break;

                case 'WHATSAPP':

                    $this->notificationService
                        ->sendWhatsapp($data);

                    break;

                default:

                    $this->notificationService
                        ->sendEmail($data);

                    break;
            }
        }

        return back()->with(
            'success',
            'Bulk notification sent successfully.'
        );
    }

    public function update(
    StoreNotificationRequest $request,
    Notification $notification
)
{
    $notification->update([

        'recipient' => $request->recipient,

        'type' => $request->type,

        'message' => $request->message
    ]);

    return back()->with(
        'success',
        'Notification updated successfully.'
    );
}

    /**
     * Delete Notification
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->delete();

        return back()->with(
            'success',
            'Notification deleted successfully.'
        );
    }
}