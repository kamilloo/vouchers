@extends('layouts.crud')


@section('list')
    <div class="row mb-4">
        <div class="btn-group" role="group" aria-label="{{__('Add Voucher')}}">
            <a href="{{ route('vouchers.create') }}" type="button" class="btn btn-outline-info">{{__('Add Voucher')}}</a>
        </div>
    </div>
    @if($vouchers->count())
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('Title')}}</th>
                <th scope="col">{{__('Type')}}</th>
                <th scope="col">{{__('Sample')}}</th>
                <th scope="col">{{__('Price')}}&nbsp;w&nbsp;zł</th>
                <th scope="col">{{__('Action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vouchers as $voucher)
                <tr>
                    <th class="align-middle" scope="row">{{ $voucher->id }}</th>
                    <td class="align-middle">{{ $voucher->title }}</td>
                    <td class="align-middle">{{ $voucher->type }}</td>
                    <td class="align-middle">
                        <img class="img-thumbnail" src="@if($voucher->file){{ asset($voucher->file) }}@else{{ asset('images/placeholder_512_x_512.png') }}@endif">

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
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirm-delete">{{__('Delete')}}</button>
                        </form>
                        </span>

                    </span>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
        <div class="m-auto col-6">
            {{ $vouchers->links() }}
        </div>
    @else
        <h4 class="p-3 mb-2 bg-warning text-dark rounded ">{{ __('There is not any :items yet.', ['items' => __('vouchers')]) }}</h4>
        @endif

@endsection
