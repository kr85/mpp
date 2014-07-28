@extends('layouts.master')

@section('content')

    <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        {{ Form::open(array('route' => 'sessions.store')) }}
            <h2>Login</h2>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <p>{{ Form::text('email', null, array('class'=>'input-text-field', 'placeholder'=>'Email')) }}</p>
            <p>{{ Form::password('password', array('class'=>'input-text-field', 'placeholder'=>'Password')) }}</p>

            <p>{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary'))}}</p>

        {{ Form::close() }}
    </div>
@stop