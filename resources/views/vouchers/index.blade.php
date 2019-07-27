@extends('vouchers.layout')


@section('list')
    <div class="btn-group" role="group" aria-label="Add Voucher">
        <a href="{{ route('vouchers.create') }}" type="button" class="btn btn-outline-info">Add Voucher</a>
    </div>
    <table class="table table-striped table-light">
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
                <th scope="row">{{ $voucher->id }}</th>
                <td>{{ $voucher->title }}</td>
                <td>{{ $voucher->type }}</td>
                <td>{{ $voucher->price }}</td>
                <td>
                    <span class="btn-group">
                        <a class="btn btn-outline-info mr-1" href="{{ route('vouchers.edit', $voucher) }}">Edycja</a>
                        <form action="{{ route('vouchers.destroy', $voucher) }}" method="post" >
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#confirm-delete">Delete</button>
                        </form>
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection