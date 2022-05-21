@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Mi perfil</h1>
@stop

@section('content')
	<div id="app">
		@include('perfil.usuario')		
	</div>
@stop
@section('css')
    <link rel="stylesheet" href="css/alertify.min.css">
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/alertify.min.js') }}"></script>
    @include('perfil.vue')
@stop