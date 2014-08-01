@extends('layouts.master')

@section('content')

    <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
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

            <p>{{ Form::text('username', null, array('placeholder'=>'Username')) }}</p>
            <p>{{ Form::text('first_name', null, array('placeholder'=>'First Name')) }}</p>
            <p>{{ Form::text('last_name', null, array('placeholder'=>'Last Name')) }}</p>
            <p>{{ Form::text('email', null, array('placeholder'=>'Email Address')) }}</p>
            <p>{{ Form::password('password', array('placeholder'=>'Password')) }}</p>
            <p>{{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password')) }}</p>

            <p>{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary'))}}</p>

        {{ Form::close() }}
    </div>
@stop