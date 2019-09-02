@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <h1>{{$student->first_name}} {{$student->last_name}}'s details</h1>

    <h2>Personal informations:</h2>
                <ul>
                    <li>First name: {{$student->first_name}}</li>
                    <li>Last name: {{$student->last_name}}</li>
                    <li>Sign: {{$student->sign}}</li>
                    <li>Group: {{$student->group}}</li>
                    <li>Age: {{$student->age}}</li>
                </ul>

    <h2>Address informations:</h2>
                @foreach($student->address as $a)
                    <ul>
                        <li>Street name: {{$a->street_name}}</li>
                        <li>Street number: {{$a->street_number}}</li>
                        <li>Zip: {{$a->zip}}</li>
                        <li>City: {{$a->city}}</li>
                        <li>Siblings: {{$a->siblings_num}}</li>
                    </ul>
    @endforeach

    <li><a href="{{ route('students.show', ['id' => $student->id]) }}">Show details</a></li>
    <li><a href="{{ route('students.edit', ['id' => $student->id]) }}">Edit student</a></li>
    <li><a href="{{ route('addresses.edit', ['id' => $student->id]) }}">Edit address</a></li>
    <li><a href="{{ route('addresses.create') }}">Add address</a></li>

@stop