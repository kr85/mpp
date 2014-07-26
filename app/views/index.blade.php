@extends('layouts.master')

@section('content')

    <h3>Index page</h3>

    @if(Sentry::check())
        {{ Sentry::getUser()->username }}

        {{ HTML::linkRoute('qa.create', 'Ask a Question!', array(), array('class' => 'btn btn-large btn-primary btn-block')) }}

    @endif
@stop