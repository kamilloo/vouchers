@extends('layouts.crud')


@section('list')
    <div class="row mb-4">
        <div class="btn-group" role="group" aria-label="Add Service Category">
            <a href="{{ route('service-packages.create') }}" type="button" class="btn btn-outline-info">Add Service Category</a>
        </div>
    </div>
    <div class="row ">
        <table class="table table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($service_packages as $service_package)
                <tr>
                    <th class="align-middle" scope="row">{{ $service_package->id }}</th>
                    <td class="align-middle">{{ $service_package->title }}</td>
                    <td class="align-middle">
                        @if($service_package->status)
                            <span class="badge-success px-2 py-1 rounded-circle"><span class="oi oi-check"></span></span>

                        @else
                            <span class="badge-danger px-2 py-1 rounded-circle"><span class="oi oi-x"></span></span>
                        @endif
                    </td>
                    <td class="align-middle">
                    <span class="btn-toolbar" role="toolbar" aria-label="Toolbar for manage category">
                        <span class="btn-group mr-2" role="group" aria-label="Update button">
                            <a class="btn btn-outline-info" href="{{ route('service-packages.edit', $service_package) }}">Edycja</a>
                        </span>
                        <span class="btn-group" role="group" aria-label="Remove button">
                        <form action="{{ route('service-packages.destroy', $service_package) }}" method="post" >
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirm-delete">Delete</button>
                        </form>
                        </span>

                    </span>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>
    </div>

@endsection
