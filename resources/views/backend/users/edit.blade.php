@extends('layouts.backend')

@section('title')
	Edit User
@stop

@section('breadcrumb')
	{{ Breadcrumbs::render('users.edit') }}
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

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Edit Item
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Edit Item</li>
			</ol>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Make Changes</h3>
						</div>
						@include('errors.forms')
						{!! Form::model($item, ['method'=>'PATCH', 'url'=>'items/'.$item->id, 'role'=>'form', 'files'=>'true']) !!}
						@include('items._form', ['buttonText'=>'Update changes'])
						{!! Form::close() !!}
					</div>
				</div>
			</div>

		</section>
	</div>
@stop