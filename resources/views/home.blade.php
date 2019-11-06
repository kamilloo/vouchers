@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-md-5  pb-1">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Share your checkout shop') }}</div>
                <div class="card-body">
                    <shop-input shop-link="{{ route('checkout.start', auth()->user()->merchant) }}"></shop-input>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-md-5 pb-xl-5">
    <div class="col-md-4 pb-1">
            <div class="card">
                <div class="card-header">Sales</div>

                <div class="card" >
                    <img class="card-img-top" src=".../100x180/">
                    <div class="card-body">
                        <h5 class="card-title">title</h5>
                        <p class="card-text">text</p>
                        <a href="#" class="btn btn-primary">text</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    <div class="col-md-4 pb-1">
            <div class="card">
                <div class="card-header">Review</div>

                <div class="card" >
                    <img class="card-img-top" src=".../100x180/">
                    <div class="card-body">
                        <h5 class="card-title">title</h5>
                        <p class="card-text">text</p>
                        <a href="#" class="btn btn-primary">text</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    <div class="col-md-4 pb-1">
            <div class="card">
                <div class="card-header">Clients</div>

                <div class="card" >
                    <img class="card-img-top" src=".../100x180/">
                    <div class="card-body">
                        <h5 class="card-title">title</h5>
                        <p class="card-text">text</p>
                        <a href="#" class="btn btn-primary">text</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
    import ShopInput from "../js/components/ShopInput";
    export default {
        components: {ShopInput}
    }
</script>
