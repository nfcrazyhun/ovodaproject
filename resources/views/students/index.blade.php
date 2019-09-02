@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <h1>Students</h1>

    <a href="/students/create"> <button type="button" class="btn btn-primary">Create New Student</button> </a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Students</th>
            <th>Addresses</th>
            <th>Links</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
            <tr>
                <td>
                    <ul>
                        <li>First name: {{$student->first_name}}</li>
                        <li>Last name: {{$student->last_name}}</li>
                        <li>Sign: {{$student->sign}}</li>
                        <li>Group: {{$student->group}}</li>
                        <li>Age: {{$student->age}}</li>
                    </ul>
                </td>
                <td>
                    @foreach($student->address as $a)
                        <ul>
                            <li>Street name: {{$a->street_name}}</li>
                            <li>Street number: {{$a->street_number}}</li>
                            <li>Zip: {{$a->zip}}</li>
                            <li>City: {{$a->city}}</li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    <ul>
                        <li><a href="{{ route('students.show', ['id' => $student->id]) }}">Edit student</a></li>
                        <li><a href="{{ route('students.edit', ['id' => $student->id]) }}">Edit student</a></li>
                        <li><a href="{{ route('addresses.edit', ['id' => $student->id]) }}">Edit address</a></li>
                        <li><a href="{{ route('addresses.create') }}">Add address</a></li>
                    </ul>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>


@stop