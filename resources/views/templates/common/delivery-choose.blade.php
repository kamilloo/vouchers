<div class="box">
    <h3 class="box-title">Select delivery option</h3>

@foreach(\App\Models\Enums\DeliveryType::all() as $delivery)
    <div class="plan-selection">
        <div class="plan-data">
            <input v-model="selectedDelivery.type" id="box-{{ $delivery }}"  name="delivery" type="radio" class="with-font" value="{{ $delivery }}" />
            <label for="box-{{ $delivery }}">{{ $delivery }}</label>
            <p class="plan-text">{{ \Illuminate\Support\Arr::get(\App\Models\Enums\DeliveryType::description(), $delivery) }}</p>
            <span class="plan-price secure-price">{{ \Illuminate\Support\Arr::get(\App\Models\Enums\DeliveryType::prices(), $delivery) }}  $</span>
        </div>
    </div>
@endforeach
@if($errors->first('delivery'))
    <span>{{ $errors->first('delivery') }}</span>
@endif
</div>
