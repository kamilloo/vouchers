@extends('layouts.crud')


@section('list')
{{--    <div class="row mb-4">--}}
{{--        <div class="btn-group" role="group" aria-label="Add Payment">--}}
{{--            <a href="{{ route('payments.create') }}" type="button" class="btn btn-outline-info">Add Payment</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    @if($payments->count())
        <table class="table table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Client') }}</th>
            <th scope="col">{{ __('Amount')}}&nbsp;w&nbsp;zł</th>
            <th scope="col">{{ __('Paid At')}}</th>
            <th scope="col">{{ __('Confirmed')}}</th>
            <th scope="col">{{ __('Order Status')}}</th>

{{--            <th scope="col">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td class="align-middle">{{ $payment->order->presenter->fullName() }}</td>
                <td>{{ $payment->presenter->amount() }}</td>
                <td>{{ $payment->presenter->paid_at() }}</td>
                <td>

                @if($payment->presenter->paid())
                    <span class="badge-success px-2 py-1 rounded-circle"><span class="oi oi-check"></span></span>

                @else
                    <span class="badge-danger px-2 py-1 rounded-circle"><span class="oi oi-x"></span></span>
                @endif
                </td>
                <td class="align-middle">
                    <span class="badge badge-info">{{ $payment->order->presenter->status() }}</span><br>
                </td>

{{--                <td>--}}
{{--                    <span class="btn-group">--}}
{{--                        <a class="btn btn-outline-info mr-1" href="{{ route('payments.edit', $payment) }}">{{ __('Edit') }}</a>--}}
{{--                        <form action="{{ route('payments.destroy', $payment) }}" method="post" >--}}
{{--                            @method('delete')--}}
{{--                            @csrf--}}
{{--                            <button type="button" class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#confirm-delete">Delete</button>--}}
{{--                        </form>--}}
{{--                    </span>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>

    </table>
        {{ $payments->render() }}
    @else
        <h4 class="p-3 mb-2 bg-warning text-dark rounded ">{{ __('There is not any :items yet.', ['items' => __('payments')]) }}</h4>
    @endif
@endsection
