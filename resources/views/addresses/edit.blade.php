@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Address $address || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Edit Student</h1>

    <!--Edit form-->
    <form method="POST" action="/students/{{$address->id}}" class="col-6">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="street_name">First Name</label>
            <input type="text" name="street_name" class="form-control" placeholder="Street name"
                   value="{{$address->street_name}}">
        </div>
        <div class="form-group">
            <label for="street_number">Last Name</label>
            <input type="text" name="street_number" class="form-control" placeholder="Street number"
                   value="{{$address->street_number}}">
        </div>
        <div class="form-group">
            <label for="zip">Zip</label>
            <input type="text" name="zip" class="form-control" placeholder="Zip"
                   value="{{$address->zip}}">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" placeholder="City"
                   value="{{$address->city}}">
        </div>
        <div class="form-group">
            <label for="siblings_num">Siblings</label>
            <input type="text" name="siblings_num" class="form-control" placeholder="Number of siblings"
                   value="{{$address->siblings_num}}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!--delete form-->
    <form method="POST" action="{{ route('addresses.destroy') }}">
        @csrf
        @method('DELETE')

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>

@stop