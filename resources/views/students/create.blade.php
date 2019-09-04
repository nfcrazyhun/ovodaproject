@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Student $student || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Create new Student</h1>

    <form method="POST" action="/students" class="col-6">
        @csrf
        <div class="form-row">
            <div class="col">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="First name">
            </div>
            <div class="col">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last name">
            </div>
        </div>
        <div class="form-group">
            <label for="sign">Sign</label>
            <input type="text" name="sign" class="form-control" placeholder="Sign">
        </div>
        <div class="form-group">
            <label for="group">Group</label>
            <input type="text" name="group" class="form-control" placeholder="Group">
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" name="age" class="form-control" placeholder="Age">
        </div>

        <button type="submit" class="btn btn-primary">Create Student</button>
    </form>

@stop