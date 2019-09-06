@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <h1>Create new address</h1>

    <form method="POST" action="{{ route('addresses.store') }}" class="col-6">
        @csrf

        <input type="hidden" name="student_id" value="{{$id}}">

        <h3>for {{\App\Student::findOrFail($id)->first_name}} {{\App\Student::findOrFail($id)->last_name}}</h3>
        <div class="form-group">
            <label for="street_name">Street name</label>
            <input type="text" name="street_name" class="form-control" placeholder="Street name"
                   value="{{ old('street_name') }}" >
        </div>
        <div class="form-group">
            <label for="street_number">Street number</label>
            <input type="text" name="street_number" class="form-control" placeholder="Street number"
                   value="{{ old('street_number') }}" >
        </div>
        <div class="form-group">
            <label for="zip">Zip</label>
            <input type="text" name="zip" class="form-control" placeholder="Zip"
                   value="{{ old('zip') }}" >
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" placeholder="City"
                   value="{{ old('city') }}" >
        </div>
        <div class="form-group">
            <label for="siblings_num">Siblings</label>
            <input type="text" name="siblings_num" class="form-control" placeholder="Number of siblings"
                   value="{{ old('siblings_num') }}" >
        </div>

        <button type="submit" class="btn btn-primary">Create</button>

    </form>

    @include('layouts.errors')

@stop