<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VoucherWasReleasedNotification extends OrderNotification implements ShouldQueue
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $voucher = $this->order->voucher->title;
        return (new MailMessage)
            ->subject(__('Voucher was released.'))
            ->line(__('Voucher was released.'))
            ->line(__('Your voucher: :voucher was released', [
                'voucher' => $voucher
            ]))
            ->action(__('You can visit details'), route('orders.index'))
            ->line(__('Thank you for using our application!'));
    }
}
