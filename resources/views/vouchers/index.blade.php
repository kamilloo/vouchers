@extends('vouchers.layout')


@section('list')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vouchers as $voucher)
            <tr>
                <td class="row">{{ $voucher->id }}</td>
                <td>{{ $voucher->title }}</td>
                <td>{{ $voucher->type }}</td>
                <td>{{ $voucher->price }}</td>
                <td><a class="btn btn-primary" href="{{ route('vouchers.edit', $voucher) }}">Edycja</a> </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection