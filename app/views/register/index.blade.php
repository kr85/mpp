@extends('layouts.master')

@section('content')

    <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 register-form">
        {{ Form::open(array('route' => 'register.store')) }}
            <h2>Register</h2>

            <ul>
                @foreach($errors->all() as $error)
                    <li style="color: red">{{ $error }}</li>
                @endforeach
            </ul>

            @if (Session::has('error'))

            @endif

            @if (Session::has('success'))
                {{ Session::get('success') }}
            @endif

            <div class="form-group">
                {{ Form::text('username', null, array('class' => 'text-field', 'placeholder'=>'Username')) }}
            </div>
            <div class="form-group">
                {{ Form::text('first_name', null, array('class' => 'text-field', 'placeholder'=>'First Name')) }}
            </div>
            <div class="form-group">
                {{ Form::text('last_name', null, array('class' => 'text-field', 'placeholder'=>'Last Name')) }}
            </div>
            <div class="form-group">
                {{ Form::text('email', null, array('class' => 'text-field', 'placeholder'=>'Email Address')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password', array('class' => 'text-field', 'placeholder'=>'Password')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password_confirmation', array('class' => 'text-field', 'placeholder'=>'Confirm Password')) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Register', array('class'=>'btn btn-block btn-large btn-primary'))}}
            </div>

        {{ Form::close() }}
    </div>
@stop