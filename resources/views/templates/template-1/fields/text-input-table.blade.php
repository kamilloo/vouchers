@foreach($fields as $field)
    @if(is_array($field))
        <div class="wrap-input1 validate-input" data-validate="{{ $data_validate }}">
            <input type="text" id="{{ implode('.',[$name, $field[0]]) }}" class="input1" aria-describedby="{{ implode('.',[$name, $field[0]]) }}-helper" name="{{ $name }}[{{ $field[0] }}]" value="{{ old(implode('.',[$name, $field[0]])) }}" placeholder="{{ implode(' ', array_map('ucfirst',explode('_',__($field[1])))) }} *">
            <span class="shadow-input1"></span>
            @if($errors->first(implode('.',[$name, $field[0]])))
                <span class="text-danger">{{ $errors->first(implode('.',[$name, $field[0]])) }}</span>
            @endif
        </div>
    @else
        <div class="wrap-input1 validate-input" data-validate="{{ $data_validate }}">
            <input type="text" id="{{ implode('.',[$name, $field]) }}" class="input1" aria-describedby="{{ implode('.',[$name, $field]) }}-helper" name="{{ $name }}[{{ $field }}]" value="{{ old(implode('.',[$name, $field])) }}" placeholder="{{ implode(' ', array_map('ucfirst',explode('_',__($field)))) }} *">
            <span class="shadow-input1"></span>
            @if($errors->first(implode('.',[$name, $field])))
                <span class="text-danger">{{ $errors->first(implode('.',[$name, $field])) }}</span>
            @endif
        </div>
    @endif

@endforeach


