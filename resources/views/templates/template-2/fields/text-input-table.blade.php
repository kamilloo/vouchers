@foreach($fields as $field)
        @if(is_array($field))
            <div class="wrap-input2 validate-input" data-validate="{{ $data_validate }}">
                <input type="text" id="{{ implode('.',[$name, $field[0]]) }}" class="input2" aria-describedby="{{ implode('.',[$name, $field[0]]) }}-helper" name="{{ $name }}[{{ $field[0] }}]" value="{{ old(implode('.',[$name, $field[0]])) }}">

                <span class="focus-input2" data-placeholder="{{ implode(' ', array_map('ucfirst',explode('_',__($field[1])))) }} *"></span>
                @if($errors->first(implode('.',[$name, $field[0]])))
                    <span class="text-danger">{{ $errors->first(implode('.',[$name, $field[0]])) }}</span>
                @endif
            </div>
        @else
            <div class="wrap-input2 validate-input" data-validate="{{ $data_validate }}">
                <input type="text" id="{{ implode('.',[$name, $field]) }}" class="input2" aria-describedby="{{ implode('.',[$name, $field]) }}-helper" name="{{ $name }}[{{ $field }}]" value="{{ old(implode('.',[$name, $field])) }}">

                <span class="focus-input2" data-placeholder="{{ implode(' ', array_map('ucfirst',explode('_',__($field)))) }} *"></span>
                @if($errors->first(implode('.',[$name, $field])))
                    <span class="text-danger">{{ $errors->first(implode('.',[$name, $field])) }}</span>
                @endif
            </div>
        @endif
@endforeach


