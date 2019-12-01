<add-voucher-service-select slot="package" value="{{ $product_id }}" name="product_id" :products="{{ $service_packages }}" label="Service Package">
    <label for="product_id" slot="label">Service Package</label>
    <div slot="error">
        @if($errors->first('product_id'))
            <span>{{ $errors->first('product_id') }}</span>
        @endif
    </div>
</add-voucher-service-select>
