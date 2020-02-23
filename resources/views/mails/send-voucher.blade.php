@component('mail::message')
# {{ __('Voucher shipped') }}

{{ __('Your Voucher has been shipped!') }}

@component('mail::button', ['url' => route('voucher.download', $order)])
    {{ __('View Voucher') }}
@endcomponent

{{ __('Your Sincerely,') }}<br>
{{ config('app.name') }}
@endcomponent
