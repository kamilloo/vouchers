@extends('layouts.crud')


@section('form')
    <div class="px-3">
        <h1 class="display-4">{{ __('Add new Voucher') }}</h1>
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
                    <div slot="title" class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="Title" value="{{ old('title') }}">
                        @if($errors->first('title'))
                            <span>{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <label slot="type-label" for="type">Select Type</label>
                    <div slot="type-error">
                           @if($errors->first('type'))
                           <span>{{ $errors->first('type') }}</span>
                            @endif
                    </div>
                    <div slot="price" class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="Price" value="{{ old('price') }}">
                        @if($errors->first('price'))
                            <span>{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <add-voucher-service-select slot="service" value="{{ old('product_id') }}" name="product_id" :products="{{ $services }}" label="Service">
                        <label for="service" slot="label">Service</label>
                        <div slot="error">
                            @if($errors->first('product_id'))
                                <span>{{ $errors->first('product_id') }}</span>
                            @endif
                        </div>
                    </add-voucher-service-select>

                <add-voucher-service-select slot="package" value="{{ old('product_id') }}" name="product_id" :products="{{ $service_packages }}" label="Service Package">
                        <label for="product_id" slot="label">Service Package</label>
                        <div slot="error">
                            @if($errors->first('product_id'))
                                <span>{{ $errors->first('product_id') }}</span>
                            @endif
                        </div>
                    </add-voucher-service-select>

                    <div class="form-group" slot="file">
                        <file-upload file-preview-width="400" file-name="file-name"></file-upload>

                    </div>
                <button type="submit" class="btn btn-primary" slot="submit">Submit</button>
            </voucher-form>

        </div>
    </div>

@endsection
