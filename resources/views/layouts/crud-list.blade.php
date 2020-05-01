@extends('layouts.crud')

@section('list')
    @yield('button-group')
    @if($show_table)
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    @yield('table-header')
                </tr>
                </thead>
                <tbody>
                    @yield('table-content')
                </tbody>

            </table>
        </div>
        <div class="m-auto col-6">
            @yield('pagination')
        </div>
    @else
        <h4 class="p-3 mb-2 bg-warning text-dark rounded ">{{ __('There is not any :items yet.', ['items' => $resource_name]) }}</h4>
    @endif
@endsection
