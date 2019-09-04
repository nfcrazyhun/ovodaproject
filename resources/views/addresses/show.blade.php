@extends('layouts.app')
@section('title', '-=app title-=')

<?php /** @var \App\Address $address || Phpstorm Blade autocomplete helper tag*/ ?>
@section('content')
    <h1>Address' details</h1>

    <ul>
        <li>Student id: {{$address->student_id}}</li>
        <li>Street name: {{$address->street_name}}</li>
        <li>Street number: {{$address->street_number}}</li>
        <li>Zip: {{$address->zip}}</li>
        <li>City: {{$address->city}}</li>
        <li>Siblings: {{$address->siblings_num}}</li>

    </ul>

    <li><a href="{{ route('addresses.edit', ['id' => $address->id]) }}">Edit address</a></li>

@stop