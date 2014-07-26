@extends('layouts.master')

@section('content')

    {{ Form::open(array('route' => 'sessions.store', 'class' => 'form-login')) }}
        <h2>Login</h2>

        @if (Session::has('errors'))

        @endif

        <p>{{ Form::text('email', null, array('class'=>'input-text-field', 'placeholder'=>'Email')) }}</p>
        <p>{{ Form::password('password', array('class'=>'input-text-field', 'placeholder'=>'Password')) }}</p>

        <p>{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}</p>

    {{ Form::close() }}

@stop