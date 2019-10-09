@extends('layouts.crud')


@section('list')
    <div class="row mb-4">
        <div class="btn-group" role="group" aria-label="Add Voucher">
            <a href="{{ route('vouchers.create') }}" type="button" class="btn btn-outline-info">Add Voucher</a>
        </div>
    </div>
    <div class="row ">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
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
                    <th class="align-middle" scope="row">{{ $voucher->id }}</th>
                    <td class="align-middle">{{ $voucher->title }}</td>
                    <td class="align-middle">{{ $voucher->type }}</td>
                    <td class="align-middle">{{ $voucher->price }}</td>
                    <td class="align-middle">
                    <span class="btn-toolbar" role="toolbar" aria-label="Toolbar for manage voucher">
                        <span class="btn-group mr-2" role="group" aria-label="Update button">
                            <a class="btn btn-outline-info" href="{{ route('vouchers.edit', $voucher) }}">Edycja</a>
                        </span>
                        <span class="btn-group" role="group" aria-label="Remove button">
                            <form action="{{ route('vouchers.destroy', $voucher) }}" method="post" >
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirm-delete">Delete</button>
                        </form>
                        </span>

                    </span>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>

@endsection
