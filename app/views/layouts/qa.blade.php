@extends('layouts.master')

@section('content')

    @include('menus.qa.top')

    <div class="container">
        @yield('qa-content')
    </div>

@stop