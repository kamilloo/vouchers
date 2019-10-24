@extends('layouts.crud')


@section('list')
    <div class="px-3">
        <h1 class="display-4">{{ __('Edit Voucher') }}</h1>
    </div>
    <div class="row py-3 px-3 border bg-white rounded-sm">
        <div class="col">
    <form method="post" enctype="multipart/form-data" action=" {{ route('vouchers.update', $voucher) }}">
        {{ csrf_field() }}
        @method('put')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="Title" value="{{ old('title') ?? $voucher->title }}">
            @if($errors->first('title'))
                <span>{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="type">Select Type</label>
            <select class="form-control" id="type" name="type">
                <option value="quote">Quote</option>
                <option value="service">Service</option>
            </select>
            @if($errors->first('type'))
            <span>{{ $errors->first('type') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="Price" value="{{ old('price') ?? $voucher->price }}">
            @if($errors->first('price'))
            <span>{{ $errors->first('price') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="service">Service</label>
            <input type="text" class="form-control" id="service" name="service" dusk="service" placeholder="Service" value="{{ old('service') ?? $voucher->service }}">
            @if($errors->first('service'))
            <span>{{ $errors->first('service') }}</span>
            @endif
        </div>
        <div class="form-group">
            <file-upload file-preview-width="400" file-name="file-name" file-src="/storage/logos/7wP5bh7oA2tAANeIztCMvhUtjJQwSPe9J3YAXQTl.jpeg"></file-upload>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
@endsection
