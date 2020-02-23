@extends('layouts.crud')


@section('list')
{{--    <div class="row mb-4">--}}
{{--        <div class="btn-group" role="group" aria-label="Add Payment">--}}
{{--            <a href="{{ route('payments.create') }}" type="button" class="btn btn-outline-info">Add Payment</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    @if($payments->count())
        <table class="table table-striped table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Client') }}</th>
            <th scope="col">{{ __('Order')}}</th>
            <th scope="col">{{ __('Voucher')}}</th>
            <th scope="col">{{ __('Price')}}</th>
            <th scope="col">{{ __('Status')}}</th>

{{--            <th scope="col">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <th scope="row">{{ $payment->id }}</th>
                <td>{{ $payment->title }}</td>
                <td>{{ $payment->type }}</td>
                <td>{{ $payment->price }}</td>
                <td>
                    <span class="btn-group">
                        <a class="btn btn-outline-info mr-1" href="{{ route('payments.edit', $payment) }}">{{ __('Edit') }}</a>
{{--                        <form action="{{ route('payments.destroy', $payment) }}" method="post" >--}}
{{--                            @method('delete')--}}
{{--                            @csrf--}}
{{--                            <button type="button" class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#confirm-delete">Delete</button>--}}
{{--                        </form>--}}
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
        {{ $payments->render() }}
    @else
        <h4 class="p-3 mb-2 bg-warning text-dark rounded ">{{ __('There is not any :items yet.', ['items' => __('payments')]) }}</h4>
    @endif
@endsection
