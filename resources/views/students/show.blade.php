@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Student $student || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>{{$student->first_name}} {{$student->last_name}}'s details</h1>

    <h2>Personal informations:</h2>
                <ul>
                    <li>First name: {{$student->first_name}}</li>
                    <li>Last name: {{$student->last_name}}</li>
                    <li>Sign: <img src="{{ asset("/images/".$student->sign)}}" height="100" width="100" title="{{$student->sign}}"></li>
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


    <li><a href="{{ route('students.edit', ['id' => $student->id]) }}">Edit student</a></li>

    {{-- if student address == null --}}
    @if ( $student->address()->where('student_id', $student->id)->first() == null )
        <li><a href="{{ route('addnewaddress', ['id' => $student->id]) }}">Add address</a></li>
    @else
        <li><a href="{{ route('addresses.edit', ['id' =>  $student->address()->where('student_id', $student->id)->first()]) }}">Edit address</a></li>
    @endif



@stop