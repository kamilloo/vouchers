@foreach($fields as $field)
    <div class="wrap-input100 validate-input" data-validate="{{ $data_validate }}">
        <input type="text" id="{{ implode('.',[$name, $field]) }}" class="input100" aria-describedby="{{ implode('.',[$name, $field]) }}-helper" name="{{ $name }}[{{ $field }}]" value="{{ old(implode('.',[$name, $field])) }}" placeholder="{{ implode(' ', array_map('ucfirst',explode('_',$field))) }}">

        <span class="focus-input100"></span>
        @if($errors->first(implode('.',[$name, $field])))
            <span>{{ $errors->first(implode('.',[$name, $field])) }}</span>
        @endif
    </div>
@endforeach


