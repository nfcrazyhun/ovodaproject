@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <h1>Create Student</h1>

    <form class="col-6">
        <div class="form-row">
            <div class="col">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" placeholder="First name">
            </div>
            <div class="col">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="Last name">
            </div>
        </div>
        <div class="form-group">
            <label for="sign">Sign</label>
            <input type="text" class="form-control" id="sign" placeholder="Sign">
        </div>
        <div class="form-group">
            <label for="group">Group</label>
            <input type="text" class="form-control" id="group" placeholder="Group">
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control" id="age" placeholder="Age">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@stop