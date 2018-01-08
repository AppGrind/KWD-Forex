@extends('layouts.backend')

@section('title')
    Show Notification
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('notifications', $notification->id) }}
@stop

@section('actions')
    @include('partials.buttons')
@stop

@section('content')

    <section class="content">
        <div class="row">  
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-sm-12">
                <div class="panel" id="daily-feed">
                    <div class="panel-heading">
                        <h3 class="panel-title">Read Notification
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group list-group-dividered list-group-full">

                            <li class="list-group-item">
                                <div class="media">
                                    <div class="pr-20">
                                        <a class="avatar avatar-away" href="javascript:void(0)">
                                            <img src="{{ Avatar::create($notification->data['sender'])->toBase64() }}" alt=""><i></i></a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-5">
                                            <small class="float-right">{{ $notification->created_at->diffForHumans()}}</small>
                                            <a class="name">{{ $notification->data['sender'] }}</a> said: {{ $notification->data['subject'] }}
                                        </h5>
                                        <small>{{ $notification->created_at->toDayDateTimeString()}}</small>
                                        <div class="content card card-default">
                                            <div class="card-block">
                                                {!! $notification->data['message'] !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
          <!-- /. panel -->
            </div>
        </div>
    </section>
@stop
@section('css')
@stop

@section('js')
@stop