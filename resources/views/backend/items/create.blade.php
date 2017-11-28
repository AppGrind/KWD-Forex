@extends('layouts.backend')

@section('title')
	Create Item
@stop


@section('breadcrumb')
	{{ Breadcrumbs::render('items.create') }}
@stop

@section('actions')
	@isset($buttons)
		@foreach($buttons as $btn)
			<a href="{{ url($btn['action']) }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="{{ $btn['title'] }}">
				<i class="{{ $btn['icon'] }}" aria-hidden="true"></i>
			</a>
		@endforeach
	@endisset
@stop

@section('content')

	<div class="panel panel-bordered">
		<div class="panel-heading with-border">
			<h3 class="panel-title">Add New Item</h3>
		</div>
        @include('errors.forms')
		<div class="panel-body">
		{!! Form::open(['url'=>'items', 'role'=>'form', 'files'=>'true']) !!}
		@include('backend.items._form', ['buttonText'=>'Save Item'])
		{!! Form::close() !!}</div>
	</div>
@stop