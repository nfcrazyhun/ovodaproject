@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <h1>Addresses</h1>

    <a href={{ route('students.create') }}> <button type="button" class="btn btn-primary">Create New Address</button> </a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Addresses</th>
            <th>Links</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($addresses as $address)
            <tr>
                <td>
                    <ul>
                        <li>Student id: {{$address->student_id}}</li>
                        <li>Street name: {{$address->street_name}}</li>
                        <li>Street number: {{$address->street_number}}</li>
                        <li>Zip: {{$address->zip}}</li>
                        <li>City: {{$address->city}}</li>
                        <li>Siblings: {{$address->siblings_num}}</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><a href="{{ route('addresses.edit', ['id' => $address->id]) }}">Edit address</a></li>
                        <li><a href="{{ route('addresses.destroy', ['id' => $address->id]) }}">Delete address</a></li>
                    </ul>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>


@stop