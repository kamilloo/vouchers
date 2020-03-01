@extends('layouts.crud')


@section('list')
{{--    <div class="row mb-4">--}}
{{--        <div class="btn-group" role="group" aria-label="Add Order">--}}
{{--            <a href="{{ route('orders.create') }}" type="button" class="btn btn-outline-info">Add Order</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    @if($orders->count())
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Client') }}</th>
            <th scope="col">{{ __('Delivery')}}</th>
            <th scope="col">{{ __('Contact')}}</th>
            <th scope="col">{{ __('Price')}}</th>
            <th scope="col">{{ __('Order Status')}}</th>
            <th scope="col">{{ __('Paid')}}</th>
{{--            <th scope="col">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <th class="align-middle" scope="row">{{ $order->id }}</th>
                <td class="align-middle">{{ $order->presenter->fullName() }}</td>
                <td class="align-middle">{{ $order->presenter->delivery() }}</td>
                <td class="align-middle">
                    Telefon: {{ $order->presenter->phone() }}
                    <br/>Email: {{ $order->presenter->email() }}
                </td>
                <td class="align-middle">{{ $order->presenter->price() }}</td>
                <td class="align-middle">{{ $order->presenter->status() }}</td>
                <td class="align-middle">
                    @if($order->presenter->paid())
                        <span class="badge-success px-2 py-1 rounded-circle"><span class="oi oi-check"></span></span>

                    @else
                        <span class="badge-danger px-2 py-1 rounded-circle"><span class="oi oi-x"></span></span>
                    @endif
                </td>
{{--                <td class="align-middle">--}}
{{--                      <span class="btn-toolbar" role="toolbar" aria-label="Toolbar for manage voucher">--}}
{{--                        <span class="btn-group mr-2" role="group" aria-label="Update button">--}}
{{--                            <a class="btn btn-outline-info mr-1" href="{{ route('orders.edit', $order) }}">Edycja</a>--}}
{{--                        </span>--}}
{{--                        <span class="btn-group" role="group" aria-label="Remove button">--}}
{{--                        <form action="{{ route('orders.destroy', $order) }}" method="post" >--}}
{{--                            @method('delete')--}}
{{--                            @csrf--}}
{{--                            <button type="button" class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#confirm-delete">Delete</button>--}}
{{--                        </form>--}}
{{--                        </span>--}}
{{--                    </span>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>

    </table>
    <div class="m-auto col-6">
        {{ $orders->links() }}
    </div>
    @else
    <h4 class="p-3 mb-2 bg-warning text-dark rounded ">{{ __('There is not any :items yet.', ['items' => __('orders')]) }}</h4>
    @endif

@endsection
