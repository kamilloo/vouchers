@extends('layouts.admin')

@section('content')
    @foreach($subscribers as $user)
        <div>{{ $user->email }}</div>
        <br>
    @endforeach
@endsection
