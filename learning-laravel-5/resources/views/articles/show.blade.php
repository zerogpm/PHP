@extends('app')

@section('content')

    <h1>{{$articles->title}}</h1>

    <hr/>

    <article>
        {{$articles->body}}
    </article>

@stop