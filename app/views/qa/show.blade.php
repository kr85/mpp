@extends('layouts.master')

@section('content')

<h1 id="replyh">{{ $question->title }}</h1>

<div class="qwrap">
	<div id="rcount">
	    Viewed {{ $question->viewed }} time{{ $question->viewed > 0 ? 's':'' }}
	</div>

	@if(count($question->answers) == 0)
		<div class="cntbox cntred">
		    <div class="cntcount">{{ count($question->answers) }}</div>
            <div class="cnttext">answers</div>
        </div>
	@elseif(count($question->answers) == 1)
		<div class="cntbox cntgreen">
		    <div class="cntcount">{{ count($question->answers) }}</div>
            <div class="cnttext">answer</div>
        </div>
	@else
		<div class="cntbox cntgreen">
		    <div class="cntcount">{{ count($question->answers) }}</div>
        	<div class="cnttext">answers</div>
        </div>
	@endif

	<div class="rblock">
		<div class="rbox">
			<p>{{ nl2br($question->question) }}</p>
		</div>
		<div class="qinfo">Asked by
		    <a href="#">
		        {{ $question->users->first_name . ' ' . $question->users->last_name }}
		    </a> on {{ date('m/d/Y H:i:s', strtotime($question->created_at)) }}
		</div>

		@if($question->tags != null)
			<ul class="qtagul">
				@foreach($question->tags as $tag)
					<li>
					    {{ HTML::linkRoute('tagged', $tag->tag, $tag->tag_name) }}
					</li>
				@endforeach
			</ul>
		@endif

		@if(Sentry::check())
			<div class="qwrap">
				<ul class="fastbar">
					@if(Sentry::getUser()->hasAccess('admin'))
					    <li>
					        <a href="{{ URL::route('question.edit', $question->id) }}">
					            {{ FA::icon('edit') }} Edit
					        </a>
					    </li>
						<li class="delete">
						    <a href="{{ URL::route('question.delete', $question->id) }}">
						        {{ FA::icon('trash-o') }} Delete
						    </a>
						</li>
						@if($question->closed == 0)
						<li class="lock">
                            <a href="{{ URL::route('question.lock', $question->id) }}">
                                {{ FA::icon('lock') }} Lock
                            </a>
                        </li>
						@else
						    <li class="unlock">
                                <a href="{{ URL::route('question.unlock', $question->id) }}">
                                    {{ FA::icon('unlock') }} Unlock
                                </a>
                            </li>
						@endif
				    @elseif(Sentry::getUser()->id == $question->user_id)
				        <li>
                    	    <a href="{{ URL::route('question.edit', $question->id) }}">
                    		    {{ FA::icon('edit') }} Edit
                    		</a>
                    	</li>
				        <li class="delete">
                            <a href="{{ URL::route('question.delete', $question->id) }}">
                        	    {{ FA::icon('trash-o') }} Delete
                        	</a>
                        </li>

					@endif
					    <li class="answer">
					        <a href="#">
					            {{ FA::icon('comment') }} Answer ( {{ count($question->answers) }} )
					        </a>
					    </li>
					    @if($question)
					        <li class="like">
					            <a href="#">
					                {{ FA::icon('thumbs-up') }} Like ( {{ $question->votes }} )
					            </a>
					        </li>
					    @else
					        <li class="unlike">
					            <a href="#">
					                {{ FA::icon('thumbs-down') }} Unlike ( {{ $question->votes }} )
					            </a>
					        </li>
					    @endif
				</ul>
			</div>
		@endif
	</div>
	<div id="rreplycount">
	    @if(count($question->answers) == 1)
	        {{ count($question->answers) }} answer
	    @else
	        {{ count($question->answers) }} answers
	    @endif
	</div>

	@if(Sentry::check())
	    @if($question->closed == 0)
            <div class="rrepol" id="replyarea" style="margin-bottom:10px">
                {{ Form::open(array('route' => array('answer.store', $question->id, Str::slug($question->title)))) }}
                    <p class="minihead">
                        Provide your Answer:
                    </p>
                    <p>
                        {{ Form::textarea('answer', Input::old('answer'), array('class' => 'fullinput')) }}
                    </p>
                    <p>
                        {{ Form::submit('Answer the Question!', array('class' => 'btn btn-large btn-primary')) }}
                    </p>
                {{Form::close()}}
            </div>
		@else
		    <div class="rrepol" id="replyarea" style="margin-bottom:10px">
		        <div class="alert alert-danger" role="alert">
		            <p>The question has been closed!</p>
		        </div>
		    </div>
		@endif
	@endif


	@if(count($question->answers))
		@foreach($question->answers as $answer)

			@if($answer->correct == 1)
				<div class="rrepol correct">
			@else
				<div class="rrepol">
			@endif

				<div class="cntbox">
					<div class="cntcount">{{ $answer->votes }}</div>
                        @if($answer->votes == 1)
                            <div class="cnttext">vote</div>
                        @else
                            <div class="cnttext">votes</div>
                        @endif
				</div>

				@if($answer->correct == 1)
					<div class="bestanswer">Best Answer!</div>
				@else
					@if(Sentry::check())
						@if(Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->id == $question->user_id)
							<a class="chooseme" href="{{ URL::route('choose.best.answer', $answer->id) }}">
							    <div class="choosebestanswer">
							        Choose
							    </div>
							</a>
						@endif
					@endif
				@endif
				<div class="rblock">
					<div class="rbox" id="rbox">
						<p>{{ nl2br($answer->answer) }}</p>
					</div>
					<div class="rrepolinf">
						<p>Answered by
						    <a href="#">
						        {{ $answer->users->first_name . ' ' . $answer->users->last_name }}
						    </a> on {{ date('m/d/Y H:i:s', strtotime($answer->created_at)) }}
						</p>

						@if(Sentry::check())
							<div class="qwrap">
								<ul class="fastbar">
									@if(Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->id == $answer->user_id)
										<li class="edit">
                                    	    <a href="{{ URL::route('answer.edit', $answer->id) }}">
                                                {{ FA::icon('edit') }} Edit
                                            </a>
                                    	</li>
										<li class="delete">
										    <a href="{{ URL::route('answer.delete', $answer->id) }}">
                                                {{ FA::icon('trash-o') }} Delete
                                            </a>
										</li>
								    @else
								        @if($question)
                                    	    <li class="like">
                                    		    <a href="#">
                                    			    {{ FA::icon('thumbs-up') }} Like
                                    			    @if($answer->votes == 0)
                                    			        ( 0 )
                                    			    @else
                                    			        ( {{ $answer->votes }} )
                                    			    @endif
                                    			</a>
                                    	    </li>
                                    	@else
                                    		<li class="unlike">
                                    		    <a href="#">
                                    			    {{ FA::icon('thumbs-down') }} Unlike ( {{ $answer->votes }} )
                                    			</a>
                                    		</li>
                                    	@endif
									@endif
								</ul>
							</div>
						@endif
					</div>
				</div>
			</div>
		@endforeach
	@endif
</div>
@stop

@section('assets')

	@if(Sentry::check())
		@if(Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->id == $question->user_id)
			<script type="text/javascript">
                $('a.chooseme').click(function() {
                    return confirm('Are you sure you want to choose this answer as best answer?');
                });
			</script>
		@endif
	@endif

	@if(Sentry::check())
		<script type="text/javascript">
            var $replyarea = $('div#replyarea');
            $replyarea.hide();
            $('li.answer a').click(function(e) {
                e.preventDefault();
                if($replyarea.is(':hidden')) {
                    $replyarea.fadeIn('fast');
                } else {
                    $replyarea.fadeOut('fast');
                }
            });
		</script>
	@endif

	@if(Sentry::check())
		@if(Sentry::getUser()->hasAccess('admin'))
			<script type="text/javascript">
                $('li.delete a').click(function() {
                    return confirm('Are you sure you want to delete this?');
                });

                $('li.lock a').click(function() {
                    return confirm('Are you sure you want to lock this question?');
                });

                $('li.unlock a').click(function() {
                    return confirm('Are you sure you want to unlock this question?');
                });
			</script>
		@endif
	@endif

    @if(Sentry::check() && (Route::currentRouteName() == 'tagged' ||  Route::currentRouteName() == 'question.show'))
        <script type="text/javascript">
            $('.arrowbox .like, .arrowbox .dislike').click(function(e){
                e.preventDefault();
                var $this = $(this);
                $.get($(this).attr('href'),function($data){
                    $this.parent('.arrowbox').next('.cntbox').find('.cntcount').text($data);
                }).fail(function(){
                    alert('An error has been occurred, please try again later');
                });
            });
        </script>
    @endif

@stop