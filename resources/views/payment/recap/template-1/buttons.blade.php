<div class="container-contact1-form-btn">
    <a type="button" class="contact1-form-btn" href="{{ route('voucher.download', $order) }}">
        <span>
             {{ __('Download') }}
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
         </span>
    </a>
    <a type="button" class="contact1-form-btn" href="{{ route('voucher.send', $order) }}">
        <span>
             {{ __('Send To Kamil') }}
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
         </span>
    </a>
    <a type="button" class="contact1-form-btn" href="{{ route('welcome') }}">
        <span>
             {{ __('Back to homepage') }}
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
         </span>
    </a>
</div>
