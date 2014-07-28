@extends('layouts.master')

@section('content')

        {{HTML::linkRoute('qa.create','Ask a question?')}}

            <h1>{{$title}}</h1>

            @if(count($questions))

                @foreach($questions as $question)

                    <div class="qwrap">
                        <?php
                            //does the question have an accepted answer?
                            $answers 	= $question->answers;
                            $accepted 	= false; //default false

                            //We loop through each answer, and check if there is an accepted answer
                            if($question->answers!=null) {
                                foreach ($answers as $answer) {
                                    //If an accepted answer is found, we break the loop
                                    if($answer->correct==1) {
                                        $accepted=true;
                                        break;
                                    }
                                }
                            }
                        ?>

                        @if($accepted)
                            <div class="cntbox cntgreen">
                        @else
                            <div class="cntbox cntred">
                        @endif
                                <div class="cntcount">
                                    {{ count($answers) }}
                                </div>
                                <div class="cnttext">
                                    @if(count($answers) <= 1)
                                        answer
                                    @else
                                        answers
                                    @endif
                                </div>
                            </div>


                        <div class="qtext">
                            <div class="qhead">
                                {{HTML::linkRoute('qa.show',$question->title,array($question->id,Str::slug($question->title)))}}
                            </div>
                            <div class="qinfo">Asked by
                                <a href="#">
                                    {{$question->users->first_name.' '.$question->users->last_name}}
                                </a> at {{date('m/d/Y H:i:s',strtotime($question->created_at))}}
                            </div>
                            @if($question->tags != null)
                                <ul class="qtagul">
                                    @foreach($question->tags as $tag)
                                        <li>
                                            {{ HTML::linkRoute('tagged' ,$tag->tag, $tag->tag_name) }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{-- and lastly, the pagination --}}
                {{$questions->links()}}

            @else
                No questions found. {{HTML::linkRoute('qa.create','Ask a question?')}}
            @endif

@stop