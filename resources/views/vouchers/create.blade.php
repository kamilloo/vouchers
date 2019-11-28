@extends('layouts.crud')


@section('form')
    <div class="px-3">
        <h1 class="display-4">{{ __('Add new Voucher') }}</h1>
    </div>
    <div class="row py-3 px-3 border bg-white rounded-sm">
        <div class="col">
            <form method="post" action="{{ route('vouchers.store') }}" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                @method('post')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="Title" value="{{ old('title') }}">
                    @if($errors->first('title'))
                        <span>{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="type">Select Type</label>
                    <select class="form-control" id="type" name="type">
                        @foreach(\App\Models\Enums\VoucherType::description() as $type => $description)
                        <option value="{{ $type }}">{{ $description }}</option>
                        @endforeach
                    </select>
                    @if($errors->first('type'))
                        <span>{{ $errors->first('type') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="Price" value="{{ old('price') }}">
                    @if($errors->first('price'))
                        <span>{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="service">Service</label>
                    <add-voucher-service-select

                        value="{{ old('service') }}"
                    >

                    </add-voucher-service-select>
                    @if($errors->first('service'))
                        <span>{{ $errors->first('service') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <file-upload file-preview-width="400" file-name="file-name"></file-upload>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
