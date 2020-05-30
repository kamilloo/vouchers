<div class="wrap-input1 validate-input" data-validate="{{ $data_validate }}">
    <input type="text" id="{{ \Illuminate\Support\Str::slug($name) }}" class="input1" aria-describedby="{{ \Illuminate\Support\Str::slug($name) }}-helper" name="{{ $name }}" value="{{ old( $name) }}" placeholder="{{ implode(' ', array_map('ucfirst',explode('_',__($name)))) }}@if($required) * @endif">
    <span class="shadow-input1"></span>
    @if($errors->first($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>
