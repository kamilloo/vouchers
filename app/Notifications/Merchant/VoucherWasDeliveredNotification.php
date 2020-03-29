<?php

namespace App\Notifications\Merchant;

use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VoucherWasDeliveredNotification extends OrderNotification implements ShouldQueue
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
        $voucher = $this->order->voucher->title;
        return (new MailMessage)
            ->subject(__('Voucher was delivered.'))
            ->line(__('Voucher was delivered.'))
            ->line(__('Your voucher: :voucher was delived to client :client', [
                'client' => $client,
                'voucher' => $voucher
            ]))
            ->action(__('You can visit details'), route('orders.index'))
            ->line(__('Thank you for using our application!'));
    }
}
