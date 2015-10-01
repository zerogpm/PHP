@extends('app')

@section('content')

    <h1>
        Write a New Article
    </h1>

    <hr/>

    {!!  Form::open(['url' => 'article']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <!--Body Form Input -->

        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

        </div>

        <!--Date Form Input -->
        <div class="form-group">
            {!! Form::label('published_at', 'Published On:') !!}
            {!! Form::input('date','published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>

        <!-- submit field Form Input -->
        <div class="form-group">
            {!! Form::submit('Add Article', ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!!  Form::close() !!}

    @if ($errors->any())

        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif

@stop