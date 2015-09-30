@extends('app')

@section('content')

    <h1>Articles</h1>

    <hr/>

    @foreach($articles as $article)

        <article>
            <h2>{{$article->title}}</h2>
        </article>

        <div class="body">
            {{$article->body}}
        </div>

    @endforeach
@stop