@extends('adminlte::page')

@section('title', 'Pagina Principal')

@section('content_header')

<div class="row">
	<div class="col-lg-9">
	<h1>Pagina Principal</h1>
	</div>
	@if(auth()->check())
	<div class="col-lg-3">
	<ul class="nav">
			<div class="col-lg-4">
		<li class="nav-item">
		<a type="button" class="btn btn-success" aria-current="page" href="{{route('home.index')}}">{{auth()->user()->correo}}</a>
	 	 </li>
		</div>
			<div class="col-lg-8">
			<li class="nav-item">
				<a type="button" class="btn btn-danger" aria-current="page" href="{{route('login.destroy')}}">Cerrar Sesión</a>
			  </li>
			</div>
	  </ul>
	</div>
	@endif
</div>
@stop
@section('content')
	<div id="app">
		@include('inicio.home')		
	</div>
@stop

{{-- @section('js')
	<script src="{{ asset('js/app.js') }}"></script>
    @include('distrito.vue')
@stop  --}}