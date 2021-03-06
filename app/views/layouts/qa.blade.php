@extends('layouts.master')

@section('content')

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 qa-main">
            @include('menus.qa.top')

                @yield('qa-content')
            </div>
            <div class="col-xs-3 col-sm-3 col-sm-offset-1 qa-sidebar">
                @include('menus.qa.sidebar')
            </div>
        </div>

@stop