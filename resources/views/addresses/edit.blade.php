@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Address $address || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Edit Address</h1>

    <!--Edit form-->
    <form method="POST" action="{{ route('addresses.update',['id' => $address->id]) }}" class="col-6">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="street_name">Street name</label>
            <input type="text" name="street_name" class="form-control" placeholder="Street name"
                   value="{{ old('street_name',$address->street_name) }}" >
        </div>
        <div class="form-group">
            <label for="street_number">Street number</label>
            <input type="text" name="street_number" class="form-control" placeholder="Street number"
                   value="{{ old('street_number',$address->street_number) }}" >
        </div>
        <div class="form-group">
            <label for="zip">Zip</label>
            <input type="text" name="zip" class="form-control" placeholder="Zip"
                   value="{{ old('zip',$address->zip) }}" >
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" placeholder="City"
                   value="{{ old('city',$address->city) }}" >
        </div>
        <div class="form-group">
            <label for="siblings_num">Siblings</label>
            <input type="text" name="siblings_num" class="form-control" placeholder="Number of siblings"
                   value="{{ old('siblings_num',$address->siblings_num) }}" >
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!--delete form-->
    <form method="POST" action="{{ route('addresses.destroy',['id' => $address->id]) }}">
        @csrf
        @method('DELETE')

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>

    @include('layouts.errors')

@stop