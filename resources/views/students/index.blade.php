@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Student $student || Phpstorm Blade autocomplete helper tag*/ ?>
<?php /** @var \App\Address $address || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Students</h1>

    <a href={{ route('students.create') }}> <button type="button" class="btn btn-primary">Create New Student</button> </a>
    <a href={{ route('addresses.create') }}> <button type="button" class="btn btn-primary">Create New Address</button> </a>

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
                    @foreach($student->address as $address)
                        <ul>
                            <li>Street name: {{$address->street_name}}</li>
                            <li>Street number: {{$address->street_number}}</li>
                            <li>Zip: {{$address->zip}}</li>
                            <li>City: {{$address->city}}</li>
                            <li>Siblings: {{$address->siblings_num}}</li>
                        </ul>
                    @endforeach
                </td>
                <td>
                    <ul>
                        <li><a href="{{ route('students.show', ['id' => $student->id]) }}">Show details</a></li>
                        <li><a href="{{ route('students.edit', ['id' => $student->id]) }}">Edit student</a></li>
                        <li>
                            <form method="POST" id="delete-form" action="{{ route('students.destroy',['id' => $student->id]) }}">
                                @csrf
                                @method('DELETE')

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete student</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>


@stop