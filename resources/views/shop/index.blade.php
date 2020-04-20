@extends('layouts.crud')

@section('list')
    <h1>{{ $tab }}</h1>
    <div class="row px-3">

        <div class="col-md-3">

            <div class="list-group"  id="design-list" role="tablist">
                <a href="#delivery" class="list-group-item list-group-item-action @if($tab == 'delivery')active @endif" data-toggle="list"  role="tab">{{ __('Delivery Cost') }}</a>

                <a href="#designs" class="list-group-item list-group-item-action @if($tab == 'designs')active @endif" data-toggle="list"  role="tab">{{ __('Designs') }}</a>
                <a href="#customs" class="list-group-item list-group-item-action @if($tab == 'customs')active @endif" data-toggle="list"  role="tab">{{ __('Customs') }}</a>
                <a href="#images" class="list-group-item list-group-item-action @if($tab == 'images')active @endif" data-toggle="list"  role="tab">{{ __('Images') }}</a>
                <a href="#settings" class="list-group-item list-group-item-action @if($tab == 'settings')active @endif" data-toggle="list"  role="tab">{{ __('Settings') }}</a>
                <a href="#gateway" class="list-group-item list-group-item-action @if($tab == 'gateway')active @endif" data-toggle="list"  role="tab">{{ __('Payment Gateway') }}</a>
            </div>
            <br>
            @if(!empty($my_template))
                <my-template :templates="{{ $templates }}" translate="{{ __('Your Design') }}" :checked="checked" :template="{{ $my_template }}" ></my-template>
            @endif
        </div>
        <!-- /.col-lg-3 -->
        <div class="col-md-9 py-3 px-3 border bg-white rounded-sm">

            <div class="tab-content">
                <div class="tab-pane @if($tab == 'delivery')active @endif" id="delivery" role="tabpanel">
                    <h2>{{ __('Delivery Cost') }}</h2>
                    <form method="post" action="{{ route('shop.delivery-settings') }}">
                        @csrf
                        @foreach(\App\Models\Enums\DeliveryType::titles() as $type => $description)
                            <input type="hidden" name="delivery[{{ $loop->index }}][type]" value="{{ $type }}">
                            <label for="delivery_cost_{{ $type }}">{{ $description }}</label>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="delivery-{{ $type }}-enabled" name="delivery[{{$loop->index}}][status]" class="custom-control-input" value="1" @if($merchant->hasDelivery($type)) checked @endif>
                                    <label class="custom-control-label" for="delivery-{{ $type }}-enabled">{{ __('Enable') }}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="front-{{ $type }}-disabled" name="delivery[{{$loop->index}}][status]" class="custom-control-input" value="0" @if(!$merchant->hasDelivery($type)) checked @endif>
                                    <label class="custom-control-label" for="front-{{ $type }}-disabled">{{ __('Disable') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" id="delivery_cost_{{ $type }}" aria-describedby="delivery_cost-help" name="delivery[{{ $loop->index }}][cost]" placeholder="{{ __('Delivery Cost') }}" value="{{ Arr::get($delivery, $type) }}">
                                <small id="delivery_cost-help" class="form-text text-muted">{{ __('Set Delivery Cost') }}.</small>
                                @if($errors->first('delivery[$loop->index][cost]'))
                                    <span class="text-danger">{{ $errors->first('delivery[$loop->index][cost]') }}</span>
                                @endif
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                    </form>
                </div>
                <div class="tab-pane @if($tab == 'designs')active @endif" id="designs" role="tabpanel">
                    <form method="post" action="{{ route('shop.change-template') }}">
                        @csrf
                        <div class="row">
                            @foreach($templates as $template)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <template-checkbox :checked="checked" @change="changeValue" :template="{{ $template }} "></template-checkbox>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>

                    </form>

                </div>
                <div class="tab-pane @if($tab == 'customs')active @endif" id="customs" role="tabpanel">
                    <form method="post" action="{{ route('shop.custom-template') }}">
                        @csrf
                        <div class="form-group">
                            <label for="background-color">{{ __('Background Color') }}</label>
                            <select class="form-control" id="background-color" aria-describedby="background-color-help" name="background_color">
                                <option value="">{{ __('default') }}</option>
                            @foreach(\App\Models\Enums\BackgroundColorType::all() as $background)
                                <option value="{{ $background }}" @if($shop_style->background_color == $background) selected @endif>
                                    {{ \App\Models\Enums\BackgroundColorType::description()[$background] }}
                                </option>
                                @endforeach
                            </select>
                            <small id="backgroudd-color-help" class="form-text text-muted">{{ __('You can choose page background color') }}.</small>
                            @if($errors->first('background_color'))
                                <span class="text-danger">{{ $errors->first('background_color') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="welcoming">{{ __('Welcoming') }}</label>
                            <input type="text" class="form-control" id="welcoming" aria-describedby="welcoming-help" name="welcoming" placeholder="{{ __('Welcome your clients') }}" value="{{ old('welcoming', $shop_style->welcoming) }}">
                            <small id="welcoming-help" class="form-text text-muted">{{ __('Welcome Your Clients') }}.</small>
                            @if($errors->first('welcoming'))
                                <span class="text-danger">{{ $errors->first('welcoming') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </form>

                </div>
                <div class="tab-pane @if($tab == 'images')active @endif" id="images" role="tabpanel">
                    <form method="post" action="{{ route('shop.change-images') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="logo-enabled" name="logo_enabled" class="custom-control-input" value="1" @if($shop_images->logo_enabled) checked @endif>
                                <label class="custom-control-label" for="logo-enabled">{{ __('Show my logo') }}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="logo-disabled" name="logo_enabled" class="custom-control-input" value="0" @if(empty($shop_images->logo_enabled)) checked @endif>
                                <label class="custom-control-label" for="logo-disabled">{{ __('Hide my logo') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <file-upload id="logo-image" file-preview-width="400" file-name="logo" file-src="{{ $shop_images->logo }}" ></file-upload>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="front-enabled" name="front_enabled" class="custom-control-input" value="1" @if($shop_images->front_enabled) checked @endif>
                                <label class="custom-control-label" for="front-enabled">{{ __('Show my Main Picture') }}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="front-disabled" name="front_enabled" class="custom-control-input" value="0" @if(empty($shop_images->front_enabled)) checked @endif>
                                <label class="custom-control-label" for="front-disabled">{{ __('Hide my Main Picture') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <file-upload id="front-image" file-preview-width="400" file-name="front" file-src="{{ $shop_images->front }}"></file-upload>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>

                    </form>
                </div>
                <div class="tab-pane @if($tab == 'settings')active @endif" id="settings" role="tabpanel">
                    <form method="post" action="{{ route('shop.shop-settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="expiry_after">{{ __('Expiry After') }}</label>
                            <input type="number" step="1" class="form-control" id="expiry_after" aria-describedby="expiry_after-help" name="expiry_after" placeholder="{{ __('Expiry After') }}" value="{{ old('expiry_after', $shop_settings->expiry_after) }}">
                            <small id="expiry_after-help" class="form-text text-muted">{{ __('Set Expiry After') }}.</small>
                            @if($errors->first('expiry_after'))
                                <span class="text-danger">{{ $errors->first('expiry_after') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                    </form>
                </div>
                <div class="tab-pane @if($tab == 'gateway')active @endif" id="gateway" role="tabpanel">
                    <form method="post" action="{{ route('shop.gateway-settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="payment_gateway_enabled">{{ __('Payment Gateway') }}</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="payment_gateway_enabled" name="payment_gateway_enabled" class="custom-control-input" value="{{ \App\Models\Enums\GatewayStatus::ENABLED }}" @if($merchant->payment_gateway_enabled == \App\Models\Enums\GatewayStatus::ENABLED) checked @endif>
                                <label class="custom-control-label" for="payment_gateway_enabled">{{ __('Enable')}}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="payment_gateway_disabled" name="payment_gateway_enabled" class="custom-control-input" value="{{ \App\Models\Enums\GatewayStatus::DISABLED }}" @if($merchant->payment_gateway_enabled == \App\Models\Enums\GatewayStatus::DISABLED) checked @endif>
                                <label class="custom-control-label" for="payment_gateway_disabled">{{ __('Disable')}}</label>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="welcoming">{{ __('Merchand Id') }}</label>
                            <input type="number" class="form-control" id="merchant_id" aria-describedby="merchant-id-help" name="merchant_id" placeholder="{{ __('Merchant Id') }}" value="{{ old('merchant_id', $merchant->merchant_id) }}">
                            <small id="merchant-id-help" class="form-text text-muted">{{ __('Set Merchant Id Gateway') }}.</small>
                            @if($errors->first('merchant_id'))
                                <span class="text-danger">{{ $errors->first('merchant_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pos_id">{{ __('POS Id') }}</label>
                            <input type="number" class="form-control" id="pos_id" aria-describedby="pos-id-help" name="pos_id" placeholder="{{ __('POS Id') }}" value="{{ old('pos_id', $merchant->pos_id) }}">
                            <small id="pos-id-help" class="form-text text-muted">{{ __('Set POS Id Gateway') }}.</small>
                            @if($errors->first('pos_id'))
                                <span class="text-danger">{{ $errors->first('pos_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="crc">{{ __('CRC') }}</label>
                            <input type="text" class="form-control" id="crc" aria-describedby="crc-help" name="crc" placeholder="{{ __('CRC') }}" value="{{ old('crc', $merchant->crc) }}">
                            <small id="crc-help" class="form-text text-muted">{{ __('Set CRC Gateway') }}.</small>
                            @if($errors->first('crc'))
                                <span class="text-danger">{{ $errors->first('crc') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sandbox" name="sandbox" class="custom-control-input" value="{{ \App\Models\Enums\GatewaySandbox::ENABLED }}" @if($merchant->sandbox == \App\Models\Enums\GatewaySandbox::ENABLED) checked @endif>
                                <label class="custom-control-label" for="sandbox">{{ __('Sandbox')}}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="live" name="sandbox" class="custom-control-input" value="{{ \App\Models\Enums\GatewaySandbox::DISABLED }}" @if($merchant->sandbox == \App\Models\Enums\GatewaySandbox::DISABLED) checked @endif>
                                <label class="custom-control-label" for="live">{{ __('Live')}}</label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
