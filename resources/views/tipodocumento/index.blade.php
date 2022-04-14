@extends('adminlte::page')

@section('title', 'Tipo de documento')

@section('content_header')
    <h1>Tipo de documento</h1>
@stop

@section('content')
	<div id="app">
		@include('tipodocumento.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('tipodocumento.vue')
@stop