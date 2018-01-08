@extends('layouts.backend')

@section('title')
	Edit Item
@stop

@section('breadcrumb')
	{{ Breadcrumbs::render('items.edit', $item) }}
@stop


@section('actions')
    @include('partials.buttons')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-8 col-sm-12 offset-lg-2">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Make Changes</h3>
                </div>
                @include('errors.forms')
                <div class="panel-body">
                    {!! Form::model($item, ['method'=>'PATCH', 'url'=>'items/'.$item->id, 'role'=>'form', 'files'=>'true']) !!}
                    @include('backend.items._form', ['buttonText'=>'Update changes'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop