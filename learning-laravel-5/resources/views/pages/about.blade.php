@extends('app')

@section('content')
    <h1>About</h1>
    <h3>People I Like</h3>
    @if(count($people))
    <ul>
        @foreach($people as $person)
            <li>{{$person}}</li>
        @endforeach
    </ul>
    @endif

    <p>Something about me is so great!</p>
@stop