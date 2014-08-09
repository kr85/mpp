@extends('layouts.master')

@section('content')

    <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 login-form">
        <h2>Login</h2>

        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>

        {{ Form::open(array('route' => 'sessions.store')) }}

        <div class="form-group">
            {{ Form::text('email', null, array('class' => 'text-field', 'placeholder' => 'Email')) }}
        </div>
        <div class="form-group">
            {{ Form::password('password', array('class' => 'text-field', 'placeholder' => 'Password')) }}
        </div>
        <div class="checkbox checkbox-width">
            <label>
                <input name="remember" type="checkbox" checked> Remember Me
            </label>
            {{ HTML::linkRoute('password.remind', 'Forgot Password?', array(), array('class' => 'pull-right forgot')) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Login', array('class' => 'btn btn-block btn-large btn-primary')) }}
        </div>

        {{ Form::close() }}
    </div>

@stop