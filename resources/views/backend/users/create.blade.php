@extends('layouts.backend')

@section('title')
	Create user
@stop

@section('breadcrumb')
	{{ Breadcrumbs::render('users.create') }}
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
				Create a new User
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Create User</li>
			</ol>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Add New</h3>
						</div>
						@include('errors.forms')
						{!! Form::open(['url'=>'users', 'role'=>'form', 'files'=>'true']) !!}
						@include('users._form', ['buttonText'=>'Save User'])
						{!! Form::close() !!}
					</div>
				</div>
			</div>

		</section>
	</div>
@stop