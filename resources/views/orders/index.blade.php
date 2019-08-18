@extends('layouts.crud')


@section('list')
    <div class="btn-group" role="group" aria-label="Add Order">
        <a href="{{ route('orders.create') }}" type="button" class="btn btn-outline-info">Add Order</a>
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
        @foreach($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->title }}</td>
                <td>{{ $order->type }}</td>
                <td>{{ $order->price }}</td>
                <td>
                    <span class="btn-group">
                        <a class="btn btn-outline-info mr-1" href="{{ route('orders.edit', $order) }}">Edycja</a>
                        <form action="{{ route('orders.destroy', $order) }}" method="post" >
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
