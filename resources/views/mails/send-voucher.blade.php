@component('mail::message')
# Voucher shipped

Your Voucher has been shipped!

@component('mail::button', ['url' => route('voucher.download', $order)])
    View Voucher
@endcomponent

Your Sincerely,<br>
{{ config('app.name') }}
@endcomponent
