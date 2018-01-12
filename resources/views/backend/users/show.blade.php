@extends('layouts.backend')

@section('title')
    {{ $user->firstname }}'s Profile
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('users', $user) }}
@stop

@section('actions')
    @include('partials.buttons')
@stop

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <!-- Page Widget -->
            <div class="card card-shadow text-center">
                <div class="card-block">
                    <a class="avatar avatar-lg" href="javascript:void(0)">
                        <img src="{{ Avatar::create($user->firstname)->toBase64() }}" />
                    </a>
                    <h4 class="profile-user">{{ $user->fullname }}</h4>
                    <p class="profile-job">{{ $user->displayname }}</p>
                    <p>{{ $user->fulladdress }}</p>
                    <div class="profile-social mb-4">
                        <i class="icon mr-1 md-email"></i> {{ $user->email }}  <i class="icon ml-2 md-phone"></i> {{ $user->contactnumber }}
                    </div>
                    <button type="button" class="btn btn-primary"> <i class="icon md-traffic mr-2"></i> {{ ucfirst($user->status_is) }}</button>
                </div>
                <div class="card-footer">
                    <div class="row no-space">
                        <div class="col-6">
                            <strong class="profile-stat-count">{{ $user->bookings->count() }}</strong>
                            <span>Bookings</span>
                        </div>
                        <div class="col-6">
                            <strong class="profile-stat-count">{{ $user->notifications->count() }}</strong>
                            <span>{{ $user->notifications->count()==1? 'Notification' : 'Notifications' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Widget -->
        </div>
        <div class="col-lg-9">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                        <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#activities" aria-controls="messages"
                                                                    role="tab">Activities</a></li>
                        <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#messages" aria-controls="messages"
                                                                    role="tab">Messages</a></li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Menu </a>
                            <div class="dropdown-menu" role="menu">
                                <a class="active dropdown-item" data-toggle="tab" href="#activities" aria-controls="activities"
                                   role="tab">Activities</a>
                                <a class="dropdown-item" data-toggle="tab" href="#messages" aria-controls="messages"
                                   role="tab">Messages</a>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane animation-slide-left" id="activities" role="tabpanel">
                            <ul class="list-group">
                                @foreach($user->notifications as $notification)
                                    @if($notification->data['type'] != "Message")
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="pr-20">
                                                <a class="avatar" href="javascript:void(0)">
                                                    <img class="img-fluid" src="{{ Avatar::create($notification->data['sender'])->toBase64() }}" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-5">{{ $notification->data['sender'] }}
                                                    <small>{{ $notification->read_at == null? 'Unread' : '' }}</small>
                                                </h5>
                                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                                                <div class="profile-brief">{{ $notification->data['message']}}</div>
                                            </div>
                                            <div class="pl-20 align-self-center">
                                                <a href="{{ route('notification.read', $notification->id ) }}" class="btn btn-icon btn-info btn-sm btn-round" data-toggle="tooltip" data-original-title="Open" ><i class="icon md-email-open mr-0"></i></a>
                                                {!! Btn::delete($notification->id, url('notifications'), false, '', 'btn-icon btn-round' , 'Are you sure you want to delete this notification?',  'Delete')!!}
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane animation-slide-left" id="messages" role="tabpanel">
                            <ul class="list-group">
                                @foreach($user->notifications as $notification)
                                    @if($notification->data['type'] == "Message")
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="pr-20">
                                                <a class="avatar" href="javascript:void(0)">
                                                    <img class="img-fluid" src="{{ Avatar::create($notification->data['sender'])->toBase64() }}" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-5">{{ $notification->data['sender'] }}
                                                    <small>{{ $notification->read_at == null? 'Unread' : '' }}</small>
                                                </h5>
                                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                                                <div class="profile-brief">{{ $notification->data['message'] }}</div>
                                            </div>
                                            <div class="pl-20 align-self-center">
                                                <a href="{{ route('notification.read', $notification->id ) }}" class="btn btn-icon btn-info btn-sm btn-round" data-toggle="tooltip" data-original-title="Open" ><i class="icon md-email-open mr-0"></i></a>
                                                {!! Btn::delete($notification->id, url('notifications'), false, '', 'btn-icon btn-round' , 'Are you sure you want to delete this notification?',  'Delete')!!}
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel -->
        </div>
    </div>
@endsection

@section('css')
    <style>
        .avatar-lg {
            width: 100px;
        }
        .page-user .page-content form {
            margin-bottom: 40px;
        }

        .page-user .page-content .list-group-item {
            padding: 25px 0;
            border-top-color: #e0e0e0;
        }

        .page-user .page-content .list-group-item:first-child {
            border-top-color: transparent;
        }

        .page-user .page-content .list-group-item:last-child {
            border-bottom-color: #e0e0e0;
        }

        .page-user .page-content .list-group-item .media-heading > small {
            margin-left: 10px;
        }

        .page-user .page-content .list-group-item p {
            margin-bottom: 5px;
        }

        .page-user .page-content .nav-tabs-horizontal {
            position: relative;
        }

        .page-user .page-content .page-user-sortlist {
            position: absolute;
            top: 5px;
            right: 0;
            z-index: 2;
        }

        @media (max-width: 991px) {
            .page-user .page-content .page-user-sortlist {
                top: -15px;
            }
        }

        @media (max-width: 479px) {
            .page-user .page-content .list-group-item .media-body {
                display: block;
                text-align: center;
            }
            .page-user .page-content .list-group-item .media-body {
                width: auto;
            }
            .page-user .page-content .list-group-item .media-body {
                margin-top: 15px;
            }
            .page-user .page-content .tab-content nav {
                text-align: center;
            }
        }

    </style>
@stop

@section('js')
    {!! Html::script("backend/global/js/Plugin/aspaginator.js") !!}
    {!! Html::script("backend/global/js/Plugin/responsive-tabs.js") !!}
    {!! Html::script("backend/global/js/Plugin/tabs.js") !!}
@stop