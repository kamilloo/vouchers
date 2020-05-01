@extends('layouts.crud-list', [
    'show_table' => $service_categories->count(),
    'resource_name' => __('categories'),

])

@section('button-group')
    @include('partials.crud-list-add-button', [
       'label' => __('Add Service Category'),
       'href' => route('service-categories.create')
    ])
@endsection

@section('table-header')
    <th scope="col">#</th>
    <th scope="col">{{ __('Title') }}</th>
    <th scope="col">{{ __('Description') }}</th>
    <th scope="col">{{ __('Active') }}</th>
    <th scope="col">{{ __('Action') }}</th>
@endsection

@section('table-content')
    @foreach($service_categories as $service_category)
        <tr>
            <th class="align-middle" scope="row">{{ $service_category->id }}</th>
            <td class="align-middle">{{ $service_category->title }}</td>
            <td class="align-middle">{{ $service_category->description ?? '-' }}</td>
            <td class="align-middle">
                @if($service_category->active)
                    <span class="badge-success px-2 py-1 rounded-circle"><span class="oi oi-check"></span></span>

                @else
                    <span class="badge-danger px-2 py-1 rounded-circle"><span class="oi oi-x"></span></span>
                @endif
            </td>
            <td class="align-middle">
                    <span class="btn-toolbar" role="toolbar" aria-label="Toolbar for manage category">
                        <span class="btn-group mr-2" role="group" aria-label="Update button">
                            <a class="btn btn-outline-info" href="{{ route('service-categories.edit', $service_category) }}">{{ __('Edit') }}</a>
                        </span>
                        <span class="btn-group" role="group" aria-label="Remove button">
                        <form action="{{ route('service-categories.destroy', $service_category) }}" method="post" >
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirm-delete" data-title="{{ $service_category->title }}">{{ __('Delete') }}</button>
                        </form>
                        </span>

                    </span>
            </td>
        </tr>

    @endforeach

@endsection

@section('pagination')
    {{ $service_categories->links() }}
@endsection
