@extends('layouts.qa')

@section('qa-content')

    <h1>Ask A Question</h1>

        @if(count($errors->all()))
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        {{ Form::open(array('route' => 'question.store')) }}

            <p>
                Title:
            </p>
            <p>
                {{ Form::text('title', Input::old('title'), array('class' => 'title-fullinput')) }}
            </p>

            <p>
                Question:
            </p>
            <p>
                {{ Form::textarea('question', Input::old('question'), array('class' => 'fullinput')) }}
            </p>

            <p>
                Tags: Use commas to split tags (tag1, tag2, ...). <br />
                To use multiple words in a tag, follow this format (tag-name-1, tag-name-2, ...).
            </p>
            <p>
                {{ Form::text('tags', Input::old('tags'), array('class' => 'title-fullinput')) }}
            </p>

            <p>
                {{ Form::submit('Ask!', array('class' => 'btn btn-large btn-primary')) }}
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