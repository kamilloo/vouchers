<div class="container-contact3-form-btn">
    <a type="button" class="contact3-form-btn" href="{{ route('voucher.download', $order) }}">{{ __('Download') }}</a>
    <a type="button" class="contact3-form-btn" href="{{ route('voucher.send', $order) }}">{{ __('Send to Kamil') }}</a>
    <a type="button" class="contact3-form-btn" href="{{ route('welcome') }}">{{ __('Back to homepage') }}</a>
</div>
