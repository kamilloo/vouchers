<div class="box">


    <voucher-type-select :voucher-types="{{ \App\Models\Enums\VoucherType::view() }}"
                         @change="changeVoucherType" v-model="voucherType">
        <slot name="type-label" slot="label">
            <h3 class="box-title">{{ __('Select you voucher type') }}</h3>
        </slot>
        <slot name="type-error" slot="error"/>
    </voucher-type-select>
    <h3 class="box-title">{{ __('Select you voucher') }}</h3>
    @foreach($vouchers as $voucher)
        <checkout-voucher-option :selected-voucher-type="voucherType" option-voucher-type="{{ $voucher->type }}">
            <slot>
                <div class="plan-data">
                    <input v-model="selectedVoucher.id" id="voucher-{{ $voucher->id }}"
                           name="voucher_id" type="radio" class="with-font"
                           value="{{ $voucher->id }}"/>
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
                            <img class="img-thumbnail" src="{{ asset($voucher->file) }}"
                                 width="150">
                        @endif
                        <span class="plan-price">{{ $voucher->presenter->price() }} zł</span>
                    </p>

                </div>
            </slot>
        </checkout-voucher-option>
    @endforeach
    @if($errors->first('voucher_id'))
        <span class="help">{{ $errors->first('voucher_id') }}</span>
    @endif
</div>

