@extends('layouts.master')

@section('content')

    @if(Sentry::getUser()->hasAccess('admin') || Sentry::getUser()->id == $user->id)

        <h1>Profile</h1>

            <p>{{ $user->username }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->first_name }}</p>
            <p>{{ $user->last_name }}</p>
            <p>{{ $user->created_at }}</p>
            <p>{{ $user->last_login }}</p>

    @endif

@stop