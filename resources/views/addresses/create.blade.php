@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Student $name || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Create new address</h1>

    <form method="POST" action="{{ route('addresses.store') }}" class="col-6">
        @csrf

        <label for="student_id">Student id</label>
            <select name="student_id" class="custom-select">
                <option selected>Choose a student which doesn't have address...</option>
                @foreach($names as $name)
                    <option value="{{$name->id}}">{{$name->first_name}} {{$name->last_name}}</option>
                @endforeach
            </select>


        {{--<div class="form-group">--}}
            {{--<label for="student_id">Student_id</label>--}}
            {{--<input type="text" name="student_id" class="form-control" placeholder="student_id">--}}
        {{--</div>--}}

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

    @include('layouts.errors')

@stop