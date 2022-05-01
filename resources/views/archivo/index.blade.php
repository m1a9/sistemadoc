@extends('adminlte::page')

@section('title', 'Locales')

@section('content_header')
    <h1>Gestión de locales</h1>
@stop

@section('content')
	<div id="app">
		@include('archivo.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('archivo.vue')
@stop