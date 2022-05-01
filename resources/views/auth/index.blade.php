 @extends('adminlte')

@section('title', 'Login')

@section('content_header')
    <h1>Login</h1>
@stop 

@section('content')
	<div id="app">
		@include('auth.login')		
	</div>
@stop
@section('css')
    <link rel="stylesheet" href="css/login.css">
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('auth.vue')
@stop