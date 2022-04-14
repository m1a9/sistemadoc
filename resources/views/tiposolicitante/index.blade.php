@extends('adminlte::page')

@section('title', 'Tipo solicitante')

@section('content_header')
    <h1>Tipo de solicitante</h1>
@stop

@section('content')
	<div id="app">
		@include('tiposolicitante.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('tiposolicitante.vue')
@stop