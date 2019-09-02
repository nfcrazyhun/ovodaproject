@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <h1>Edit Student</h1>

    <form method="POST" action="/students/{{$student->id}}" class="col-6">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <div class="col">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="First name" value="{{$student->first_name}}">
            </div>
            <div class="col">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last name" value="{{$student->last_name}}">
            </div>
        </div>
        <div class="form-group">
            <label for="sign">Sign</label>
            <input type="text" name="sign" class="form-control" placeholder="Sign" value="{{$student->sign}}">
        </div>
        <div class="form-group">
            <label for="group">Group</label>
            <input type="text" name="group" class="form-control" placeholder="Group" value="{{$student->group}}">
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" name="age" class="form-control" placeholder="Age" value="{{$student->age}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@stop