<div class="container-contact2-form-btn">
    <div class="wrap-contact2-form-btn">
        <div class="contact2-form-bgbtn"></div>
        <a type="button" class="contact2-form-btn" href="{{ route('voucher.download', $order) }}">{{ __('Download') }}</a>
    </div>
    <div class="wrap-contact2-form-btn">
        <div class="contact2-form-bgbtn"></div>
        <a type="button" class="contact2-form-btn" href="{{ route('voucher.send', $order) }}">{{ __('Send To Kamil') }}</a>
    </div>
    <div class="wrap-contact2-form-btn">
        <div class="contact2-form-bgbtn"></div>
        <a type="button" class="contact2-form-btn" href="{{ route('welcome') }}">{{ __('Back to homepage') }}</a>
    </div>
</div>
