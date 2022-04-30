@extends('adminlte::page')

@section('title', 'Paises')

@section('content_header')
    <h1>Gestión de paises</h1>
@stop

@section('content')
	<div id="app">
		@include('paises.pais')		
	</div>
@stop
@section('css')
    <link rel="stylesheet" href="css/alertify.min.css">
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/alertify.min.js') }}"></script>
    @include('paises.vue')
@stop