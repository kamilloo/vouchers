@foreach($fields as $field)
    <div class="wrap-input2 validate-input" data-validate="{{ $data_validate }}">
        <input type="text" id="{{ implode('.',[$name, $field]) }}" class="input2" aria-describedby="{{ implode('.',[$name, $field]) }}-helper" name="{{ $name }}[{{ $field }}]" value="{{ old(implode('.',[$name, $field])) }}">

        <span class="focus-input2" data-placeholder="{{ implode(' ', array_map('ucfirst',explode('_',__($field)))) }}"></span>
        @if($errors->first(implode('.',[$name, $field])))
            <span>{{ $errors->first(implode('.',[$name, $field])) }}</span>
        @endif
    </div>
@endforeach


