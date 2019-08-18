@extends('layouts.crud')


@section('list')
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
            <label for="file-sample">Add Sample</label>
            <input type="file" class="form-control-file" id="file-sample" name="file-sample">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
