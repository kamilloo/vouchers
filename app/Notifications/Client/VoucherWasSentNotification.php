<?php

namespace App\Notifications\Client;

use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VoucherWasSentNotification extends OrderNotification implements ShouldQueue
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
            ->subject(__('Voucher was sent.'))
            ->line(__('Voucher was sent.'))
            ->line(__('Your voucher: :voucher was sent to you, please check you inbox :client', [
                'client' => $client,
                'voucher' => $voucher
            ]))
            ->line(__('Thank you for using our application!'));
    }
}
