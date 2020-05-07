@extends('layouts.admin')

@section('content')
    @foreach($users as $user)
        <div>{{ $user->name }}</div>
        <br>
    @endforeach
@endsection
