@extends('layouts.master')

@section('content')

    <h3>Index page</h3>

    @if(Sentry::check())
        {{ Sentry::getUser()->username }}
    @endif

@stop