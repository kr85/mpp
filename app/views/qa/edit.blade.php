@extends('layouts.master')

@section('content')


    <h1>Edit A Question</h1>

        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>

    {{ Form::model($question, array('route' => array('question.update', $question->id), 'method' => 'patch')) }}

        <p>
            Title:
        </p>
        <p>
            {{ Form::text('title', Input::old('title'), array()) }}
        </p>

        <p>
            Question:
        </p>
        <p>
            {{ Form::textarea('question', Input::old('question'), array()) }}
        </p>
        <p>
            {{ Form::submit('Edit!', array('class' => 'btn btn-large btn-primary')) }}
        </p>

    {{ Form::close() }}

@stop