<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentWasBeganNotification extends OrderNotification implements ShouldQueue
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
            ->subject(__('Payment was began.'))
            ->line(__('Payment was began.'))
            ->line(__('Client :client began payment your voucher: :voucher', [
                'client' => $client,
                'voucher' => $voucher
            ]))
            ->action(__('You can visit details'), route('transactions.index'))
            ->line(__('Thank you for using our application!'));
    }
}
