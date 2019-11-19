@extends('layouts.crud')


@section('list')
    <div class="px-3">
        <h1 class="display-4">{{ __('Edit Category') }}</h1>
    </div>
    <div class="row py-3 px-3 border bg-white rounded-sm">
        <div class="col">
    <form method="post" enctype="multipart/form-data" action=" {{ route('service-categories.update', $service_category) }}">
        {{ csrf_field() }}
        @method('put')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="Title" value="{{ old('title') ?? $service_category->title }}">
            @if($errors->first('title'))
                <span>{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <input type="text" class="form-control" id="title" name="description" dusk="description" placeholder="Description" value="{{ old('description') ?? $service_category->description }}">
            @if($errors->first('description'))
                <span>{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\CategoryStatus::ACTIVE }}" @if($service_category->active)checked @endif>
            <label class="custom-control-label" for="active">Active</label>
        </div>
        <div class="custom-control custom-radio mb-3">
            <input type="radio" id="in-active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\CategoryStatus::INACTIVE }}" @if(!$service_category->active)checked @endif>
            <label class="custom-control-label" for="in-active">Inactive</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
@endsection
