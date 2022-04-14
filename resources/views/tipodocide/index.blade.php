@extends('adminlte::page')

@section('title', 'Documento de identidad')

@section('content_header')
    <h1>Documentos de identidad</h1>
@stop

@section('content')
	<div id="app">
		@include('tipodocide.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('tipodocide.vue')
@stop