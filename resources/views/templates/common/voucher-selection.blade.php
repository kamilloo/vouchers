<div class="box">
{{--    <select v-model="voucherType" name="voucher_type">--}}
{{--        @foreach(\App\Models\Enums\VoucherType::description() as $voucher_type)--}}
{{--        <option @if(old('voucher_type') == $voucher_type['value']) selected @endif value="{{ $voucher_type['value'] }}">{{ $voucher_type['label'] }}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
    <h3 class="box-title">{{ __('Select you voucher') }}</h3>
    @foreach($vouchers as $voucher)
    <div class="plan-selection " >
        <div class="plan-data">
            <input v-model="selectedVoucher.id" id="voucher-{{ $voucher->id }}" name="voucher_id" type="radio" class="with-font" value="{{ $voucher->id }}" />
            <label for="voucher-{{ $voucher->id }}">
                {!! $voucher->presenter->label() !!}
            </label>

            <p class="plan-text">

            @if(!$voucher->isQuoteType())
                @if(!empty($voucher->product->description))
                {{ __('Description') }}: {{ $voucher->product->description }}
                @endif
            @endif
            @if($voucher->file)
                <br>
                <img class="img-thumbnail" src="{{ asset($voucher->file) }}" width="150">
            @endif
                <span class="plan-price">{{ $voucher->presenter->price() }} zł</span>
            </p>

        </div>
    </div>
    @endforeach
    @if($errors->first('voucher_id'))
    <span class="help">{{ $errors->first('voucher_id') }}</span>
    @endif
</div>

