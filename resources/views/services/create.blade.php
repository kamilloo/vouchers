@extends('layouts.crud')


@section('form')
    <div class="px-3">
        <h1 class="display-4">{{ __('Add Service') }}</h1>
    </div>
    <div class="row py-3 px-3 border bg-white rounded-sm">
        <div class="col">
            <form method="post" action="{{ route('services.store') }}" role="form">
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
                    <label for="description">{{ __('Description') }}</label>
                    <input type="text" class="form-control" id="title" name="description" dusk="description" placeholder="Description" value="{{ old('description') }}">
                    @if($errors->first('description'))
                        <span>{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="Price" value="{{ old('price') }}">
                    @if($errors->first('price'))
                        <span>{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\ServiceStatus::ACTIVE }}">
                    <label class="custom-control-label" for="active">Active</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                    <input type="radio" id="in-active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\ServiceStatus::INACTIVE }}">
                    <label class="custom-control-label" for="in-active">Inactive</label>
                </div>

                <div class="form-group">
                    @foreach($service_categories as $service_category)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="category-{{ $service_category->id }}" name="categories[]" value="{{ $service_category->id }}">
                            <label class="custom-control-label" for="category-{{ $service_category->id }}">{{ $service_category->title }}</label>
                        </div>
                    @endforeach
                </div>

                @include('partials.new-category-input')

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
