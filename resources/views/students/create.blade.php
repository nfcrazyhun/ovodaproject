@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Student $student || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Create new Student</h1>

    <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data" class="col-6">
        @csrf
        <div class="form-row">
            <div class="col">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="First name"
                       value="{{ old('first_name') }}" >
            </div>
            <div class="col">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last name"
                       value="{{ old('last_name') }}" >
            </div>
        </div>
        <div class="form-group">
            <label for="sign">Sign</label>
            <input type="file" name="sign" class="form-control" placeholder="Sign"
                   value="{{ old('sign') }}" >
        </div>
        <div class="form-group">
            <label for="group">Group</label>
            <input type="text" name="group" class="form-control" placeholder="Group"
                   value="{{ old('group') }}" >
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" name="age" class="form-control" placeholder="Age"
                   value="{{ old('age') }}" >
        </div>

        <button type="submit" class="btn btn-primary">Create Student</button>
    </form>

    @include('layouts.errors')

@stop