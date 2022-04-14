@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <h1>Lista de Categorias</h1>
@stop

@section('content')
	<div id="app">
		@include('categoria.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('categoria.vue')
@stop