@extends('adminlte::page')

@section('title', 'Solicitud de Trámite')

@section('content_header')
    <h1>Solicitud de Trámite</h1>
@stop

@section('content')
	<div id="app">
		@include('documento.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('documento.vue')
@stop