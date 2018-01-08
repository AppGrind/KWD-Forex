@extends('layouts.backend')

@section('title')
	Show Item
@stop

@section('breadcrumb')
	{{ Breadcrumbs::render('items.show', $item) }}
@stop


@section('actions')
    @include('partials.buttons')
@stop

@section('content')

	<div class="panel">
		<div class="panel-content">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $item->name }}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group list-group-full">
                    <li class="list-group-item">
                        <div class="media">
                            <div class="pr-20">
                                <a class="avatar" href="javascript:void(0)">
                                    <i class="icon md-money"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-5">R{{ $item->price }}</h5>
                                <small>Price</small>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="media">
                            <div class="pr-20">
                                <a class="avatar" href="javascript:void(0)">
                                    <i class="icon md-traffic"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-5">{{ $item->status_is }}</h5>
                                <small>Status</small>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="media">
                            <div class="pr-20">
                                <a class="avatar" href="javascript:void(0)">
                                    <i class="icon md-calendar-note"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-5">{{ $item->created_at }}</h5>
                                <small>Create on</small>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="media">
                            <div class="pr-20">
                                <a class="avatar" href="javascript:void(0)">
                                    <i class="icon md-calendar-check"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-5">{{ $item->updated_at }}</h5>
                                <small>Modified on</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
		</div>
	</div>
@stop