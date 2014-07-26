@extends('layouts.master')

@section('content')

    {{ Form::open(array('route' => 'sessions.store', 'class' => 'form-login')) }}
        <h2>Login</h2>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        @if (Session::has('error'))
            {{ Session::get('error') }}
        @endif

        @if (Session::has('success'))
            {{ Session::get('success') }}
        @endif

        <p>{{ Form::text('email', null, array('class'=>'input-text-field', 'placeholder'=>'Email')) }}</p>
        <p>{{ Form::password('password', array('class'=>'input-text-field', 'placeholder'=>'Password')) }}</p>

        <p>{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}</p>

    {{ Form::close() }}

@stop