@extends('adminlte::page')

@section('title', 'Provincias')

@section('content_header')
    <h1>Lista de Provincias</h1>
@stop

@section('content')
	<div id="app">
		@include('provincia.provincia')		
	</div>
@stop
@section('css')
    <link rel="stylesheet" href="css/alertify.min.css">
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/alertify.min.js') }}"></script>
    @include('provincia.vue')
@stop

