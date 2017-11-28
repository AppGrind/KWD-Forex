@extends('layouts.backend')

@section('title')
	Create Invoice
@stop


@section('breadcrumb')
	{{ Breadcrumbs::render('invoices.create') }}
@stop

@section('actions')
	@isset($button)
		@foreach($buttons as $btn)
			<a href="{{ url($btn['action']) }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="{{ $btn['title'] }}">
				<i class="{{ $btn['icon'] }}" aria-hidden="true"></i>
			</a>
		@endforeach
	@endisset
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Create Item</div>

					<div class="panel-body">
						@include('errors.forms')

						{!! Form::open(['url'=>'/admin/items', 'role'=>'form', 'files'=>'true']) !!}
							@include('backend.items._form', ['buttonText'=>'Save Item'])
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
