@extends('layouts.qa')

@section('qa-content')

    <h1>{{ $title }}</h1>

    @if($tags)

        @foreach($tags as $tag)
            @if(count($tag->questions) != 0)
                <div class="qtext">
                    <ul class="qtagul">
                        <li>
                            {{ HTML::linkRoute('question.tagged' ,$tag->tag, $tag->tag_name) }}
                        </li>
                    </ul>
                </div>
            @endif
        @endforeach

    @else
        <p>No tags were found.</p>
    @endif

@stop