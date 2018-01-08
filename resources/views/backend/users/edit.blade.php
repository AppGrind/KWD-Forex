@extends('layouts.backend')

@section('title')
	Edit {{ $user->fullname  }}'s Profile
@stop

@section('breadcrumb')
	{{ Breadcrumbs::render('users.edit', $user) }}
@stop


@section('actions')
	@include('partials.buttons')
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg 2">
            <div class="panel panel-bordered">
                <div class="panel-heading with-border">
					<h3 class="panel-title">Make Changes</h3>
				</div>
				@include('errors.forms')
                <div class="panel-body">
                    {!! Form::model($user, ['method'=>'PATCH', 'url'=>'users/'.$user->id, 'role'=>'form', 'files'=>'true']) !!}
                    @include('backend.users._form', ['buttonText'=>'Update changes'])
                    {!! Form::close() !!}
                </div>
			</div>
		</div>
	</div>
@stop

@section('js')
	{!! Html::script("backend/global/vendor/typeahead-js/bloodhound.min.js") !!}
	{!! Html::script("backend/global/vendor/typeahead-js/typeahead.jquery.min.js") !!}
	{!! Html::script("backend/assets/js/typeahead-init.js") !!}
@stop
@section('css')
	{!! Html::style("backend/global/vendor/typeahead-js/typeahead.css") !!}
@stop