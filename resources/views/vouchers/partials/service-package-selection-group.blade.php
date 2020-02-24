<add-voucher-service-select slot="package" value="{{ $product_id }}" name="product_id" :products="{{ $service_packages }}" label="{{__('Service Package')}}">
    <label for="product_id" slot="label">{{__('Service Package')}}</label>
    <div slot="error">
        @if($errors->first('product_id'))
            <span class="text-danger">{{ $errors->first('product_id') }}</span>
        @endif
    </div>
</add-voucher-service-select>
