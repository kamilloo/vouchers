@extends('layouts.crud')


@section('list')
    <div class="row mb-4">
        <div class="btn-group" role="group" aria-label="Add Order">
            <a href="{{ route('orders.create') }}" type="button" class="btn btn-outline-info">Add Order</a>
        </div>
    </div>
    @if($orders->count())
    <table class="table table-striped table-hover">
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
        @foreach($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td class="align-middle">{{ $order->title }}</td>
                <td class="align-middle">{{ $order->type }}</td>
                <td class="align-middle">{{ $order->price }}</td>
                <td class="align-middle">
                      <span class="btn-toolbar" role="toolbar" aria-label="Toolbar for manage voucher">
                        <span class="btn-group mr-2" role="group" aria-label="Update button">
                            <a class="btn btn-outline-info mr-1" href="{{ route('orders.edit', $order) }}">Edycja</a>
                        </span>
                        <span class="btn-group" role="group" aria-label="Remove button">
                        <form action="{{ route('orders.destroy', $order) }}" method="post" >
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#confirm-delete">Delete</button>
                        </form>
                        </span>
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    @else
    <h4 class="p-3 mb-2 bg-warning text-dark rounded ">{{ __('There is not any order yet.') }}</h4>
    @endif

@endsection
