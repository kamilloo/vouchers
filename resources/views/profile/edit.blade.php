@extends('profile.layout')


@section('logo')
    <avatar></avatar>
@endsection

@section('form.button')
    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Save"/>
@endsection

@section('about')
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label>Last Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $guard->user()->profile->last_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label>First Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $guard->user()->profile->first_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label>Adres</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Adres" name="address" value=" {{ $guard->user()->profile->address }}">
            </div>
        </div>
    </div>
@endsection
<script>
    import Avatar from "../../js/components/Avatar";
    export default {
        components: {Avatar}
    }
</script>