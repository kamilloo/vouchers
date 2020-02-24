<div class="wrap-input100 validate-input" data-validate="{{ $data_validate }}">
    <input type="text" id="{{ \Illuminate\Support\Str::slug($name) }}" class="input100" aria-describedby="{{ \Illuminate\Support\Str::slug($name) }}-helper" name="{{ $name }}" value="{{ old( $name) }}" placeholder="{{ implode(' ', array_map('ucfirst',explode('_',__($name)))) }}">
    <span class="focus-input100" ></span>
    @if($errors->first($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>
