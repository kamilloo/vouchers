<checkout-form
    :delivery-types="{{ json_encode($delivery_options) }}"
    :vouchers="{{ json_encode($voucher_presenters) }}"
    :selected-voucher="selectedVoucher"
    :selected-delivery="selectedDelivery"
    :translate="translate"
    old-voucher-id="{{ old('voucher_id') }}"
    old-delivery="{{ old('delivery') }}"
></checkout-form>
