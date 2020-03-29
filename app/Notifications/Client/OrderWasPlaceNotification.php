<?php

namespace App\Notifications\Client;

use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderWasPlaceNotification extends OrderNotification implements ShouldQueue
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $client = $this->order->getClientName();
        $voucher = $this->order->voucher->getTable();
        $merchant = $this->order->merchant;
        return (new MailMessage)
            ->subject(__('Order was placed.'))
            ->line(__('Thank you for your Order :client', [
                'client' => $client,
            ]))
            ->line(__('Your ordered voucher: :voucher', [
                'voucher' => $voucher
            ]))
            ->action(__('Pay'),route('payment.create', [
                'merchant' => $merchant,
                'order' => $this->order
            ]))
            ->line(__('Thank you for using our application!'));
    }
}
