@extends('layouts.qa')

@section('qa-content')

    @if(Route::currentRouteName() == 'question.index' || Route::currentRouteName() == 'question.tagged')

            <h1>{{ $title }}</h1>

            @if(count($questions))

                @foreach($questions as $question)

                    <div class="qwrap">
                        <?php
                            $answers  = $question->answers;
                            $accepted = false;

                            if($question->answers != null) {
                                foreach ($answers as $answer) {
                                    if($answer->correct == 1) {
                                        $accepted = true;
                                        break;
                                    }
                                }
                            }
                        ?>

                        @if($accepted)
                            <div class="cntbox cntgreen">
                        @elseif(count($answers) == 0)
                            <div class="cntbox cntred">
                        @else
                            <div class="cntbox">
                        @endif
                                <div class="cntcount">
                                    {{ count($answers) }}
                                </div>
                                <div class="cnttext">
                                    @if(count($answers) == 1)
                                        answer
                                    @else
                                        answers
                                    @endif
                                </div>
                            </div>


                        <div class="qtext">
                            <div class="qhead">
                                {{ HTML::linkRoute('question.show', $question->title, array($question->id)) }}
                            </div>
                            <div class="qinfo">Asked by
                                <a href="#">
                                        {{ $question->users->first_name . ' ' . $question->users->last_name }}
                                </a> at {{ date('m/d/Y H:i:s', strtotime($question->created_at)) }}
                            </div>
                            @if($question->tags != null)
                                <ul class="qtagul">
                                    @foreach($question->tags as $tag)
                                        <li>
                                            {{ HTML::linkRoute('question.tagged' ,$tag->tag, $tag->tag_name) }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{ $questions->links() }}

            @else
                <p>No questions found.</p>
            @endif

    @elseif(Route::currentRouteName() == 'question.unanswered')

            <h1>{{ $title }}</h1>

            @if(count($questions))

                @foreach($questions as $question)

                    <?php
                        $answers = $question->answers;
                    ?>

                        <div class="qwrap">
                                <div class="cntbox cntred">
                                    <div class="cntcount">
                                        {{ count($answers) }}
                                    </div>
                                    <div class="cnttext">
                                        @if(count($answers) == 1)
                                            answer
                                        @else
                                            answers
                                        @endif
                                    </div>
                                </div>


                            <div class="qtext">
                                <div class="qhead">
                                    {{ HTML::linkRoute('question.show', $question->title, array($question->id)) }}
                                </div>
                                <div class="qinfo">Asked by
                                    <a href="#">
                                            {{ $question->users->first_name . ' ' . $question->users->last_name }}
                                    </a> at {{ date('m/d/Y H:i:s', strtotime($question->created_at)) }}
                                </div>
                                @if($question->tags != null)
                                    <ul class="qtagul">
                                        @foreach($question->tags as $tag)
                                            <li>
                                                {{ HTML::linkRoute('question.tagged' ,$tag->tag, $tag->tag_name) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                @endforeach

                {{ $questions->links() }}

            @else
                <p>No questions found.</p>
            @endif
    @elseif(Route::currentRouteName() == 'question.tags')

            <h1>{{ $title }}</h1>

            @if(count($questions))

                @foreach($questions as $question)
<?php dd($question); ?>
                        <div class="qwrap">
                            <div class="qtext">
                                @if($question->tags != null)
                                    <ul class="qtagul">
                                        @foreach($question->tags as $tag)
                                            <li>
                                                {{ HTML::linkRoute('question.tagged' ,$tag->tag, $tag->tag_name) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                @endforeach

                {{-- $questions->links() --}}

            @else
                <p>No tags found.</p>
            @endif
    @endif

@stop