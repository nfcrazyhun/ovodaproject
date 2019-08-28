@extends('layouts.app')
@section('title', '-=app title-=')

@section('content')
    <div>
        <p>This is my body content.</p>

        @foreach ($students as $student)
            <li>{{ $student->first_name }} {{ $student->last_name }}</li>
        @endforeach

    </div>
@stop