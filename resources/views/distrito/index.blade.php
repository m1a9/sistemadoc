@extends('adminlte::page')

@section('title', 'Distrito')

@section('content_header')
    <h1>Distritos</h1>
@stop

@section('content')
	<div id="app">
		@include('distrito.distrito')		
	</div>
@stop

@section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('distrito.vue')
@stop 