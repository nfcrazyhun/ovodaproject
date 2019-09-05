@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <h1>Create new address</h1>

    <form method="POST" action="{{ route('addresses.store') }}" class="col-6">
        @csrf

        <div class="form-group">
            <label for="student_id">Street name</label>
            <input type="text" name="student_id" class="form-control" placeholder="student_id">
        </div>

        <div class="form-group">
            <label for="street_name">Street name</label>
            <input type="text" name="street_name" class="form-control" placeholder="Street name">
        </div>
        <div class="form-group">
            <label for="street_number">Street number</label>
            <input type="text" name="street_number" class="form-control" placeholder="Street number">
        </div>
        <div class="form-group">
            <label for="zip">Zip</label>
            <input type="text" name="zip" class="form-control" placeholder="Zip">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" placeholder="City">
        </div>
        <div class="form-group">
            <label for="siblings_num">Siblings</label>
            <input type="text" name="siblings_num" class="form-control" placeholder="Number of siblings">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>

    </form>

@stop