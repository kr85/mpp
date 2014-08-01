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
            Questions's title:
        </p>
        <p>
            {{ Form::text('title', Input::old('title'), array()) }}
        </p>

        <p>
            Ask your question:
        </p>
        <p>
            {{ Form::textarea('question', Input::old('question'), array()) }}
        </p>

        <p>
            Tags: Use commas to split tags (tag1, tag2, ...). <br />
            To use multiple words in a tag, follow this format (tag-name-1, tag-name-2, ...).
        </p>
        <p>
            {{ Form::text('tags', Input::old('tags'), array()) }}
        </p>

        <p>
            {{ Form::submit('Edit') }}
        </p>

    {{ Form::close() }}

@stop