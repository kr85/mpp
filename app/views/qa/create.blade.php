@extends('layouts.master')

@section('content')

    <h1>Ask A Question</h1>

    {{ Form::open(array('route' => 'qa.store')) }}

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
            {{ Form::submit('Ask this Question') }}
        </p>

    {{ Form::close() }}
@stop

@section('assets')

    <script type="text/javascript">
        $('input[name="tags"]').keyup(function() {
            $(this).val($(this).val().toLowerCase());
        });
    </script>

@stop