<div class="wrap-input2 validate-input" data-validate="{{ $data_validate }}">
    <input type="text" id="{{ \Illuminate\Support\Str::slug($name) }}" class="input2" aria-describedby="{{ \Illuminate\Support\Str::slug($name) }}-helper" name="{{ $name }}" value="{{ old( $name) }}">
    <span class="focus-input2" data-placeholder="{{ implode(' ', array_map('ucfirst',explode('_',$name))) }}"></span>
    @if($errors->first($name))
        <span>{{ $errors->first($name) }}</span>
    @endif
</div>
