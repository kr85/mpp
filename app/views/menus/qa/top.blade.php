
@if(Route::currentRouteName() == 'question.index')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-warning btn-size">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.show')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-warning btn-size">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.edit')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-warning btn-size">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.create')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary btn-size">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-warning btn-size">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.tagged')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary btn-size">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-warning btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@else
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary btn-size">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@endif