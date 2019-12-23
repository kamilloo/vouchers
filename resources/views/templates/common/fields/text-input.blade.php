<div class="{{ $wrapper_class }}" data-validate="{{ $data_validate }}">
    <input type="text" id="{{ $id }}" class="{{ $input_class }}" aria-describedby="{{ $id }}-helper" name="{{ $name }}" value="{{ old( $name) }}" placeholder="{{ implode(' ', array_map('ucfirst',explode('_',$name))) }}">
    <span class="shadow-input1"></span>
    @if($errors->first($name))
        <span>{{ $errors->first($name) }}</span>
    @endif
</div>
