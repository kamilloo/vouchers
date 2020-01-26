<div class="box">
    <h3 class="box-title">Select you voucher</h3>
    @foreach($vouchers as $voucher)
    <div class="plan-selection">
        <div class="plan-data">
            <input v-model="selectedVoucher.id" id="voucher-{{ $voucher->id }}" name="voucher_id" type="radio" class="with-font" value="{{ $voucher->id }}" />
            <label for="voucher-{{ $voucher->id }}">{{ $voucher->title }}</label>

            <p class="plan-text">
{{--                {{ __('You can used full quote whatever.') }}--}}


            @if(!$voucher->isQuoteType())
                {{ __('Service') }}: {{ $voucher->product->title }}
                @if(!empty($voucher->product->description))
                    <br>
                {{ __('Description') }}: {{ $voucher->product->description }}
                @endif
            @endif
                <span class="plan-price">{{ $voucher->presenter->price() }} zł</span>
            </p>

        </div>
    </div>
    @endforeach
    @if($errors->first('voucher_id'))
    <span>{{ $errors->first('voucher_id') }}</span>
    @endif
</div>

