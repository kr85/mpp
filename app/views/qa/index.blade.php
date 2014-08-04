@extends('layouts.qa')

@section('qa-content')

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
                                {{ HTML::linkRoute('question.show', $question->title, array($question->id, Str::slug($question->title))) }}
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

@stop