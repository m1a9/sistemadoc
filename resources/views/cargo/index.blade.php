@extends('adminlte::page')

@section('title', 'Cargo')

@section('content_header')
    <h1>Cargos</h1>
@stop

@section('content')
	<div id="app">
		@include('cargo.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('cargo.vue')
@stop