@extends('vouchers.layout')


@section('list')
    <form>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="type">Select Type</label>
            <select class="form-control" id="type" name="type">
                <option value="quote">Quote</option>
                <option value="service">Service</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="Price">
        </div>
        <div class="form-group">
            <label for="service">Service</label>
            <input type="text" class="form-control" id="service" name="service" dusk="service" placeholder="Service">
        </div>
        <div class="form-group">
            <label for="file-sample">Add Sample</label>
            <input type="file" class="form-control-file" id="file-sample" name="file-sample">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection