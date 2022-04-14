@extends('adminlte::page')

@section('title', 'Tipo de usuario')

@section('content_header')
    <h1>Tipo de usuario</h1>
@stop

@section('content')
	<div id="app">
		@include('tipousuario.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('tipousuario.vue')
@stop