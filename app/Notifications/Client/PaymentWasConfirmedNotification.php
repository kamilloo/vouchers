<?php

namespace App\Notifications\Client;

use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentWasConfirmedNotification extends OrderNotification implements ShouldQueue
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $client = $this->order->getClientEmail();
        $voucher = $this->order->voucher->getTable();
        return (new MailMessage)
            ->subject(__('Payment was confirmed.'))
            ->line(__('Payment was confirmed.'))
            ->line(__('Your payment for your voucher: :voucher was confirmed', [
                'voucher' => $voucher
            ]))
            ->action(__('Download'), route('voucher.download', $this->order))
            ->line(__('Thank you for using our application!'));
    }
}
