<add-voucher-service-select slot="service" value="{{ $product_id }}" name="product_id" :products="{{ $services }}" label="Service">
    <label for="service" slot="label">Service</label>
    <div slot="error">
        @if($errors->first('product_id'))
            <span>{{ $errors->first('product_id') }}</span>
        @endif
    </div>
</add-voucher-service-select>
