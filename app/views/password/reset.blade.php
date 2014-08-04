@extends('layouts.master')

@section('content')

    <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">

        <h2 class="">Reset Your Password</h2>

        {{ Form::open(array('route' => array('password.update', $token))) }}

        <div class="form-group">
            {{ Form::text('email', null, array('class' => 'text-field', 'placeholder' => 'Your Email')) }}
        </div>
        <div class="form-group">
            {{ Form::password('password', array('class' => 'text-field', 'placeholder'=>'New Password')) }}
        </div>
        <div class="form-group">
            {{ Form::password('password_confirmation', array('class' => 'text-field', 'placeholder'=>'Confirm New Password')) }}
        </div>

        {{ Form::hidden('token', $token) }}

        <div class="form-group">
            {{ Form::submit('Reset Password', array('class' => 'btn btn-block btn-large btn-primary')) }}
        </div>

        {{ Form::close() }}

     </div>
@stop