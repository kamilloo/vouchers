@extends('layouts.crud')


@section('form')
    <div class="px-3">
        <h1 class="display-4">{{ __('Add Package') }}</h1>
    </div>
    <div class="row py-3 px-3 border bg-white rounded-sm">
        <div class="col">
            <form method="post" action="{{ route('service-packages.store') }}" role="form">
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
                        <input type="radio" id="active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\PackageStatus::ACTIVE }}">
                        <label class="custom-control-label" for="active">{{__('Active')}}</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="in-active" name="active" class="custom-control-input" value="{{ \App\Models\Enums\PackageStatus::INACTIVE }}">
                        <label class="custom-control-label" for="in-active">{{__('Inactive')}}</label>
                    </div>
                    @if($errors->first('active'))
                        <span class="text-danger">{{ $errors->first('active') }}</span>
                    @endif
                </div>

                @if(!$services->count())
                    <h4 class="p-3 mb-2 bg-warning text-dark rounded "><a href="{{ route('services.create') }}">{{ __('Please add :items first.', ['items' => __('services')]) }}</a></h4>
                @else
                <div class="form-group">
                    <label for="categories">{{ __('Choose Services')}}</label>
                @foreach($services as $service)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="service-{{ $service->id }}" name="services[]" value="{{ $service->id }}">
                            <label class="custom-control-label" for="service-{{ $service->id }}">{{ $service->title }}</label>
                        </div>
                    @endforeach
                    @if($errors->first('services'))
                        <span class="text-danger">{{ $errors->first('services') }}</span>
                    @endif
                </div>
                @endif

                @if($service_categories->count())
                <div class="form-group">
                    <label for="categories">{{ __('Choose Categories')}}</label>
                    @foreach($service_categories as $service_category)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="category-{{ $service_category->id }}" name="categories[]" value="{{ $service_category->id }}" >
                            <label class="custom-control-label" for="category-{{ $service_category->id }}">{{ $service_category->title }}</label>
                        </div>
                    @endforeach
                    @if($errors->first('categories'))
                        <span class="text-danger">{{ $errors->first('categories') }}</span>
                    @endif
                </div>
                @endif
                @include('partials.new-category-input', ['service_categories' => $service_categories])


                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </form>
        </div>
    </div>

@endsection
