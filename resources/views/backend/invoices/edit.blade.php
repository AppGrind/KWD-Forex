@extends('layouts.backend')

@section('title')
	Edit Invoices
@stop

@section('breadcrumb')
	{{ Breadcrumbs::render('invoices.edit') }}
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
					<div class="panel-heading">Item Changes</div>

					<div class="panel-body">
						@include('errors.forms')

						{!! Form::model($item, ['method'=>'PATCH', 'url'=>'/admin/items/'.$item->id, 'role'=>'form', 'files'=>'true']) !!}
						@include('backend.items._form', ['buttonText'=>'Update changes'])
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop