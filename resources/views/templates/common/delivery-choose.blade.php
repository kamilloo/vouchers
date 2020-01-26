<div class="box">
    <h3 class="box-title">Select delivery option</h3>

@foreach($delivery_options as $delivery)
    <div class="plan-selection">
        <div class="plan-data">
            <input v-model="selectedDelivery.type" id="box-{{ $delivery->getType() }}"  name="delivery" type="radio" class="with-font" value="{{ $delivery->getType() }}" />
            <label for="box-{{ $delivery->getType() }}">{{ $delivery->getTitle() }}</label>
            <p class="plan-text">{{ $delivery->getDescription() }}</p>
            <span class="plan-price secure-price">{{ $delivery->getCost() }}  zł</span>
        </div>
    </div>
@endforeach
@if($errors->first('delivery'))
    <span>{{ $errors->first('delivery') }}</span>
@endif
</div>
