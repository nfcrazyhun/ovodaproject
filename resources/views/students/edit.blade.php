@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Student $student || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Edit Student</h1>

    <!--Edit form-->
    <form method="POST" action="{{ route('students.update',['id' => $student->id]) }}" class="col-6">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <div class="col">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="First name"
                       value="{{ old('first_name',$student->first_name) }}" >
            </div>
            <div class="col">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last name"
                       value="{{ old('last_name',$student->last_name) }}" >
            </div>
        </div>
        <div class="form-group">
            <label for="sign">Sign</label>
            <input type="text" name="sign" class="form-control" placeholder="Sign"
                   value="{{ old('sign',$student->sign) }}" >
        </div>
        <div class="form-group">
            <label for="group">Group</label>
            <input type="text" name="group" class="form-control" placeholder="Group"
                   value="{{ old('group',$student->group) }}">
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" name="age" class="form-control" placeholder="Age"
                   value="{{ old('age',$student->age) }}" >
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!--delete form-->
    <form method="POST" action="{{ route('students.destroy',['id' => $student->id]) }}">
        @csrf
        @method('DELETE')

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>

    @include('layouts.errors')

@stop