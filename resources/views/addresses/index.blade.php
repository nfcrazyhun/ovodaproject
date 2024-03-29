@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Address $address || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Addresses</h1>

    <a href={{ route('addresses.create') }}> <button type="button" class="btn btn-primary">Create New Address</button> </a>

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
                    <ul class="list-group">
                        {{--<li>Student id: {{$address->student_id}}</li>--}}
                        <li class="list-group-item list-group-item-primary">Student: {{$address->student->first_name}} {{$address->student->last_name}}</li>
                        <li class="list-group-item">Street name: {{$address->street_name}}</li>
                        <li class="list-group-item">Street number: {{$address->street_number}}</li>
                        <li class="list-group-item">Zip: {{$address->zip}}</li>
                        <li class="list-group-item">City: {{$address->city}}</li>
                        <li class="list-group-item">Siblings: {{$address->siblings_num}}</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><a href="{{ route('addresses.show', ['id' => $address->id]) }}">Show details</a></li>
                        <li><a href="{{ route('addresses.edit', ['id' => $address->id]) }}">Edit address</a></li>
                    </ul>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

    {{ $addresses->links() }}

@stop