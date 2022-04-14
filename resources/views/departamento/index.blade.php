@extends('adminlte::page')

@section('title', 'Departamento')

@section('content_header')
    <h1>Lista de Departamentos</h1>
@stop

@section('content')
	<div id="app">
		@include('departamento.departamento')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('departamento.vue')
@stop
