<checkout-form
    :delivery-types="{{ json_encode(\App\Models\Enums\DeliveryType::all()) }}"
    :vouchers="{{ json_encode($vouchers) }}"
    :selected-voucher="selectedVoucher"
    :selected-delivery="selectedDelivery"
></checkout-form>
