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
                    <label for="title">{{__('Title')}}</label>
                    <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="{{__('Title')}}" value="{{ old('title') }}">
                    @if($errors->first('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <input type="text" class="form-control" id="title" name="description" dusk="description" placeholder="{{__('Description')}}" value="{{ old('description') }}">
                    @if($errors->first('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">{{__('Price')}}&nbsp;w&nbsp;zł</label>
                    <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="{{__('Price')}}" value="{{ old('price') }}">
                    @if($errors->first('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="active">{{ __('Status')}}</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\ServiceStatus::ACTIVE }}">
                        <label class="custom-control-label" for="active">{{__('Active')}}</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="in-active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\ServiceStatus::INACTIVE }}">
                        <label class="custom-control-label" for="in-active">{{__('Inactive')}}</label>
                    </div>
                    @if($errors->first('active'))
                        <span class="text-danger">{{ $errors->first('active') }}</span>
                    @endif
                </div>

                @if($service_categories->count())

                <div class="form-group">
                    <label for="categories">{{ __('Choose Categories')}}</label>

                @foreach($service_categories as $service_category)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="category-{{ $service_category->id }}" name="categories[]" value="{{ $service_category->id }}">
                            <label class="custom-control-label" for="category-{{ $service_category->id }}">{{ $service_category->title }}</label>
                        </div>
                    @endforeach
                </div>
                <@endif
                @include('partials.new-category-input', ['service_categories' => $service_categories])

                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </form>
        </div>
    </div>

@endsection
