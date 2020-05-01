@extends('layouts.crud-list', [
    'show_table' => $services->count(),
    'resource_name' => __('services'),

])

@section('button-group')

    @include('partials.crud-list-add-button', [
       'label' => __('Add Service'),
       'href' => route('services.create')
    ])
@endsection


@section('table-header')
    <th scope="col">#</th>
    <th scope="col">{{ __('Title') }}</th>
    <th scope="col">{{ __('Description') }}</th>
    <th scope="col">{{ __('Price') }}&nbsp;w&nbsp;zł</th>
    <th scope="col">{{ __('Status') }}</th>
    <th scope="col">{{ __('Categories') }}</th>
    <th scope="col">{{ __('Action') }}</th>
@endsection


@section('table-content')
    @foreach($services as $service)
        <tr>
            <th class="align-middle" scope="row">{{ $service->id }}</th>
            <td class="align-middle">{{ $service->title }}</td>
            <td class="align-middle">{{ $service->description }}</td>
            <td class="align-middle">{{ $service->price }} zł</td>
            <td class="align-middle">
                @if($service->active)
                    <span class="badge-success px-2 py-1 rounded-circle"><span class="oi oi-check"></span></span>

                @else
                    <span class="badge-danger px-2 py-1 rounded-circle"><span class="oi oi-x"></span></span>
                @endif
            </td>
            <td class="align-middle">
                @if(! $service->categories->count())
                    <span class="badge badge-warning"></span>
                @endif
                @foreach($service->categories as $category)
                    <span class="badge badge-info">{{ $category->title }}</span><br>
                @endforeach
            </td>
            <td class="align-middle">
                    <span class="btn-toolbar" role="toolbar" aria-label="Toolbar for manage category">
                        <span class="btn-group mr-2" role="group" aria-label="Update button">
                            <a class="btn btn-outline-info" href="{{ route('services.edit', $service) }}">{{ __('Edit') }}</a>
                        </span>
                        <span class="btn-group" role="group" aria-label="Remove button">
                        <form action="{{ route('services.destroy', $service) }}" method="post" >
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirm-delete" data-title="{{ $service->title }}">{{ __('Delete') }}</button>
                        </form>
                        </span>

                    </span>
            </td>
        </tr>
    @endforeach
@endsection

@section('pagination')
{{ $services->links() }}

@endsection
