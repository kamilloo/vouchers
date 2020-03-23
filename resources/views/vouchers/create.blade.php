@extends('layouts.crud')


@section('form')
    <div class="px-3">
        <h1 class="display-4">{{ __('Add Voucher') }}</h1>
    </div>
    <div class="row py-3 px-3 border bg-white rounded-sm">
        <div class="col">
            <voucher-form action="{{ route('vouchers.store') }}"
            :voucher-types="{{ \App\Models\Enums\VoucherType::view() }}"
            voucher-quote-type="{{ \App\Models\Enums\VoucherType::QUOTE }}"
            voucher-service-type="{{ \App\Models\Enums\VoucherType::SERVICE }}"
            voucher-service-package-type="{{ \App\Models\Enums\VoucherType::SERVICE_PACKAGE }}"
            flash-voucher-type="{{ old('type') }}"
            >
                    <div slot="method">
                        @method('post')
                    </div>
                    <div slot="csrf">
                        @csrf
                    </div>
                    @include('vouchers.partials.title-group', ['description' => old('description') ])
                    @include('vouchers.partials.type-group')
                    @include('vouchers.partials.price-group', ['price' => old('price')])
                    @include('vouchers.partials.service-selection-group', ['product_id' => old('product_id')])
                    @include('vouchers.partials.service-package-selection-group', ['product_id' => old('product_id')])
                    @include('vouchers.partials.file-group', ['file_src' => ''])
                    @include('vouchers.partials.submit', ['label' => __('Submit')])
            </voucher-form>

        </div>
    </div>

@endsection
