@extends('layouts.crud-list', [
    'show_table' => $payments->count(),
    'resource_name' => __('payments'),

])

@section('button-group')

{{--    @include('partials.crud-list-add-button', [--}}
{{--       'label' => __('Add Payment'),--}}
{{--       'href' => route('payments.create')--}}
{{--    ])--}}
@endsection

@section('table-header')
    <th scope="col">#</th>
    <th scope="col">{{ __('Client') }}</th>
    <th scope="col">{{ __('Amount')}}&nbsp;w&nbsp;zł</th>
    <th scope="col">{{ __('Paid')}}</th>
    <th scope="col">{{ __('Order Status')}}</th>

    {{--            <th scope="col">Action</th>--}}
@endsection

@section('table-content')
    @foreach($payments as $payment)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td class="align-middle">{{ $payment->order->presenter->fullName() }}</td>
            <td>{{ $payment->presenter->amount() }}</td>
            <td>
                @if($payment->presenter->paid())
                    <span class="badge-success px-2 py-1 rounded-circle"><span class="oi oi-check"></span></span>
                    &nbsp;{{ $payment->presenter->paidAt() }}

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

@endsection

@section('pagination')
    {{ $payments->render() }}

@endsection
