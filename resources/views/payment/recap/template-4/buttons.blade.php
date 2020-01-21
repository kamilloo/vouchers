<div class="container-contact100-form-btn">
    <div class="wrap-contact100-form-btn">
        <div class="contact100-form-bgbtn"></div>
        <a type="button" class="contact100-form-btn" href="{{ route('voucher.download', $order) }}">
            <span>
                {{ __('Download') }}
                <i class="fa fa-long-arrow-right m-l-7"
                   aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="wrap-contact100-form-btn">
        <div class="contact100-form-bgbtn"></div>
        <a type="button" class="contact100-form-btn" href="{{ route('voucher.send', $order) }}">
            <span>
                {{ __('Send To Kamil') }}
                <i class="fa fa-long-arrow-right m-l-7"
                   aria-hidden="true"></i>
            </span>
        </a>
    </div>
    {{--                                <div class="wrap-contact100-form-btn">--}}
    {{--                                    <div class="contact100-form-bgbtn"></div>--}}
    {{--                                    <a type="button" class="contact100-form-btn" href="{{ route('voucher.push', $order) }}">--}}
    {{--                                        <span>--}}
    {{--                                            {{ __('Send SMS') }}--}}
    {{--                                            <i class="fa fa-long-arrow-right m-l-7"--}}
    {{--                                               aria-hidden="true"></i>--}}
    {{--                                        </span>--}}
    {{--                                    </a>--}}
    {{--                                </div>--}}
    <div class="wrap-contact100-form-btn">
        <div class="contact100-form-bgbtn"></div>
        <a type="button" class="contact100-form-btn" href="{{ route('welcome') }}">
            <span>
                {{ __('Back to homepage') }}
                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
            </span>
        </a>
    </div>
</div>
