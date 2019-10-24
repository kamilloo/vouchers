@extends('layouts.crud')

@section('list')
    <div class="row px-3">

        <div class="col-md-3">

            <div class="list-group"  id="design-list" role="tablist">
                <a href="#designs" class="list-group-item list-group-item-action active" data-toggle="list"  role="tab">{{ __('Designs') }}</a>
                <a href="#customs" class="list-group-item list-group-item-action" data-toggle="list"  role="tab">{{ __('Customs') }}</a>
                <a href="#images" class="list-group-item list-group-item-action" data-toggle="list"  role="tab">{{ __('Images') }}</a>
            </div>
            <br>
            @if(!empty($my_template))
                <h1 class="my-4">{{ __('Your Design') }}</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top" src="{{ $my_template->thumbnail }}" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#">{{ $my_template->title }}</a>
                                </h4>
                                <h5>${{ $my_template->price }}</h5>
                                <p class="card-text">{{ $my_template->description }}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <!-- /.col-lg-3 -->
        <div class="col-md-9 py-3 px-3 border bg-white rounded-sm">

            <div class="tab-content">
                <div class="tab-pane active" id="designs" role="tabpanel">
                    <form method="post" action="{{ route('shop.change-template') }}">
                        @csrf
                        <div class="row">
                            @foreach($templates as $template)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100">

                                        <div class="position-absolute">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="template_id" id="template-radio-{{ $template->id  }}" value="{{ $template->id }}">
                                                <label class="form-check-label" for="template-radio-{{ $template->id  }}">
                                                    << {{ $template->title }} >>
                                                </label>
                                            </div>
                                        </div>

                                        <a href="#"><img class="card-img-top" src="{{ $template->thumbnail }}" alt=""></a>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="#">{{ $template->title }}</a>
                                            </h4>
                                            <h5>${{ $template->price }}</h5>
                                            <p class="card-text">{{ $template->description }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
                <div class="tab-pane" id="customs" role="tabpanel">
                    <form method="post" action="{{ route('shop.custom-template') }}">
                        @csrf
                        <div class="form-group">
                            <label for="background-color">{{ __('Background Color') }}</label>
                            <select class="form-control" id="background-color" aria-describedby="background-color-help" name="background_color">
                                <option value="">--</option>
                            @foreach(\App\Models\Enums\BackgroundColorType::all() as $background)
                                <option value="{{ $background }}" @if($shop_style->background_color == $background) selected @endif>{{ $background }}</option>
                                @endforeach
                            </select>
                            <small id="backgroudd-color-help" class="form-text text-muted">{{ __('You can choose page background color') }}.</small>
                        </div>

                        <div class="form-group">
                            <label for="welcoming">{{ __('Welcoming') }}</label>
                            <input type="text" class="form-control" id="welcoming" aria-describedby="welcoming-help" name="welcoming" placeholder="{{ __('Welcome your clients') }}" value="{{ old('welcoming', $shop_style->welcoming) }}">
                            <small id="welcoming-help" class="form-text text-muted">{{ __('Welcome Your Clients') }}.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <div class="tab-pane" id="images" role="tabpanel">
                    <form method="post" action="{{ route('shop.change-images') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="logo-enabled" name="logo_enabled" value="1" @if($shop_images->logo_enabled) checked @endif>
                            <label class="form-check-label" for="logo-enabled">{{ __('Show my logo') }} checked</label>
                        </div>
                        <div class="form-group">
                            <file-upload id="logo-image" file-preview-width="400" file-name="logo" file-src="{{ $shop_images->logo }}" ></file-upload>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="front-enabled" name="front_enabled" value="1" @if($shop_images->front_enabled) checked @endif>
                            <label class="form-check-label" for="front-enabled">{{ __('Show my Main Picture') }}</label>
                        </div>
                        <div class="form-group">
                            <file-upload id="front-image" file-preview-width="400" file-name="front" file-src="{{ $shop_images->front }}"></file-upload>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
