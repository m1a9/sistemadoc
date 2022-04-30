@extends('adminlte::page')

@section('title', 'Locales')

@section('content_header')
    <h1>Gestión de locales</h1>
@stop

@section('content')
	<div id="app">
		@include('area.principal')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('area.vue')
@stop