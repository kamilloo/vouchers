@extends('layouts.crud')


@section('list')
    <div class="px-3">
        <h1 class="display-4">{{ __('Edit Voucher') }}</h1>
    </div>
    <div class="row py-3 px-3 border bg-white rounded-sm">
        <div class="col">

            <voucher-form action="{{ route('vouchers.update', $voucher) }}"
                          :voucher-types="{{ \App\Models\Enums\VoucherType::view() }}"
                          voucher-quote-type="{{ \App\Models\Enums\VoucherType::QUOTE }}"
                          voucher-service-type="{{ \App\Models\Enums\VoucherType::SERVICE }}"
                          voucher-service-package-type="{{ \App\Models\Enums\VoucherType::SERVICE_PACKAGE }}"
                          flash-voucher-type="{{ old('type')  ?? $voucher->type}}"
            >
                <div slot="method">
                    @method('put')
                </div>
                <div slot="csrf">
                    @csrf
                </div>
                @include('vouchers.partials.title-group', ['title' => old('title') ?? $voucher->title ])
                @include('vouchers.partials.type-group')
                @include('vouchers.partials.price-group', ['price' => old('price') ?? $voucher->price])
                @include('vouchers.partials.service-selection-group', ['product_id' => old('product_id') ?? $voucher->product_id])
                @include('vouchers.partials.service-package-selection-group', ['product_id' => old('product_id') ?? $voucher->product_id])
                @include('vouchers.partials.file-group', ['file_src' => "/storage/logos/7wP5bh7oA2tAANeIztCMvhUtjJQwSPe9J3YAXQTl.jpeg"])
                @include('vouchers.partials.submit', ['label' => __('Save')])

            </voucher-form>

        </div>
    </div>
@endsection
