
@if(Route::currentRouteName() == 'question.index')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-warning">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.show')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-warning">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.edit')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-warning">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.create')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-warning">Ask a Question?</span></a>
@elseif(Route::currentRouteName() == 'question.tagged')
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-warning">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary">Ask a Question?</span></a>
@else
    <a href="{{ URL::route('question.index') }}"><span class="btn btn-large btn-primary">Questions</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Unanswered</span></a>
    <a href="#"><span class="btn btn-large btn-primary">Tags</span></a>
    <a href="{{ URL::route('question.create') }}"><span class="btn btn-large btn-primary">Ask a Question?</span></a>
@endif