@extends('layouts.crud')


@section('list')
    <div class="row mb-4">
        <div class="btn-group" role="group" aria-label="{{ __('Add Service') }}">
            <a href="{{ route('services.create') }}" type="button" class="btn btn-outline-info">{{ __('Add Service') }}</a>
        </div>
    </div>
    @if($services->count())
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Title') }}</th>
                <th scope="col">{{ __('Description') }}</th>
                <th scope="col">{{ __('Price') }}&nbsp;w&nbsp;zł</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col">{{ __('Categories') }}</th>
                <th scope="col">{{ __('Action') }}</th>
            </tr>
            </thead>
            <tbody>
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
            </tbody>

        </table>
    <div class="m-auto col-6">
        {{ $services->links() }}
    </div>
    @else
        <h4 class="p-3 mb-2 bg-warning text-dark rounded ">{{ __('There is not any :items yet.', ['items' => __('services')]) }}</h4>
    @endif

@endsection
