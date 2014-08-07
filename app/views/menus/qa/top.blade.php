
@if(Route::currentRouteName() == 'question.index' || Route::currentRouteName() == 'question.show' || Route::currentRouteName() == 'question.edit' || Route::currentRouteName() == 'question.update')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-warning btn-size">Questions</span></a>
    <a href="{{ URL::route('question.unanswered') }}"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="{{ URL::route('question.tags') }}"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.create')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary btn-size">Questions</span></a>
    <a href="{{ URL::route('question.unanswered') }}"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="{{ URL::route('question.tags') }}"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-warning btn-size">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.tagged' || Route::currentRouteName() == 'question.tags')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary btn-size">Questions</span></a>
    <a href="{{ URL::route('question.unanswered') }}"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="{{ URL::route('question.tags') }}"><span class="btn btn-large btn-warning btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.unanswered')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary btn-size">Questions</span></a>
    <a href="{{ URL::route('question.unanswered') }}"><span class="btn btn-large btn-warning btn-size">Unanswered</span></a>
    <a href="{{ URL::route('question.tags') }}"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@else
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary btn-size">Questions</span></a>
    <a href="{{ URL::route('question.unanswered') }}"><span class="btn btn-large btn-primary btn-size">Unanswered</span></a>
    <a href="{{ URL::route('question.tags') }}"><span class="btn btn-large btn-primary btn-size">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary btn-size">Ask a Question?</span></a>
@endif