@extends('layouts.crud-list', [
    'show_table' => $vouchers->count(),
    'resource_name' => __('vouchers'),

])

@section('button-group')

@include('partials.crud-list-add-button', [
   'label' => __('Add Voucher'),
   'href' => route('vouchers.create')
])
@endsection

@section('table-header')
    <th scope="col">#</th>
    <th scope="col">{{__('Voucher')}}</th>
    <th scope="col">{{__('Type')}}</th>
    <th scope="col">{{__('Sample')}}</th>
    <th scope="col">{{__('Price')}}&nbsp;w&nbsp;zł</th>
    <th scope="col">{{__('Action')}}</th>
@endsection

@section('table-content')
    @foreach($vouchers as $voucher)
        <tr>
            <th class="align-middle" scope="row">{{ $voucher->id }}</th>
            <td class="align-middle">
                {!! $voucher->presenter->title() !!}
                @if($voucher->description)
                    <br>({{ $voucher->description }})
                @endif
            </td>
            <td class="align-middle">
                {{ $voucher->presenter->type() }}
            </td>
            <td class="align-middle">
                <img class="img-thumbnail" width="80" src="@if($voucher->file){{ asset($voucher->file) }}@else{{ asset('images/placeholder_512_x_512.png') }}@endif">

            </td>
            <td class="align-middle">{{ $voucher->presenter->price() }}</td>
            <td class="align-middle">
                    <span class="btn-toolbar" role="toolbar" aria-label="Toolbar for manage voucher">
                        <span class="btn-group mr-2" role="group" aria-label="Update button">
                            <a class="btn btn-outline-info" href="{{ route('vouchers.edit', $voucher) }}">{{__('Edit')}}</a>
                        </span>
                        <span class="btn-group" role="group" aria-label="Remove button">
                            <form action="{{ route('vouchers.destroy', $voucher) }}" method="post" >
                            @method('delete')
                                @csrf
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirm-delete" data-title="{!! $voucher->presenter->title() !!}">{{__('Delete')}}</button>
                        </form>
                        </span>

                    </span>
            </td>
        </tr>

    @endforeach

@endsection

@section('pagination')
    {{ $vouchers->links() }}
@endsection
