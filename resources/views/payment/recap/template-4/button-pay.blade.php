<div class="container-contact100-form-btn">
    <div class="wrap-contact100-form-btn">
        <div class="contact100-form-bgbtn"></div>
        <a type="button" class="contact100-form-btn" href="{{ route('payment.create', compact('merchant', 'order') ) }}">
            <span>
                {{ __('Pay') }}
                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
            </span>
        </a>
    </div>
</div>
