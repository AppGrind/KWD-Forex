@extends('layouts.backend')

@section('title')
    Dashboard
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@stop



@section('content')
    @if($events->count() > 0)
        @if($events->where('status_is', 'Open')->count() > 0)
            <div class="row list-of-events" data-plugin="matchHeight" data-by-row="true">
                @foreach($events as $event)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="panel">
                        <span class="ribbon ribbon-badge ribbon-reverse ribbon-bottom ribbon-{{ $event->status_is=='Open' ? 'success' : 'danger'}}">
                            <span class="ribbon-inner">{{$event->status_is}}</span>
                        </span>

                        <div class="panel-heading">

                            <h3 class="panel-title">{{ $event->name }}</h3>

                            <div class="panel-actions panel-actions-keep">
                                <div class="dropdown ">
                                    <a class="panel-action" data-toggle="dropdown" href="#" aria-expanded="false"><i class="icon md-info-outline" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu dropdown-menu-bullet dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="{{ route('events.show', $event->id) }}" role="menuitem"><i class="icon md-eye" aria-hidden="true"></i> View Details</a>
                                        @if(Gate::allows('admin'))
                                        <a class="dropdown-item" href="{{ route('guest.add', $event->id) }}" role="menuitem"><i class="icon md-account-add" aria-hidden="true"></i> Add Guest</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="counter counter-md text-left">
                                <div class="counter-number-group mb-10">
                                    <span class="counter-number">R{{ $event->item->price }}</span>
                                </div>
                                <p class="card-text text-truncate mb-2"><i class="icon md-format-subject mr-2"></i>
                                    {{ $event->description }}
                                </p>
                                <p class="mb-2"><i class="icon md-calendar mr-2"></i> {{ $event->start_date->format('D, M jS Y') }}
                                    - {{ $event->end_date->format('D, M jS Y') }}</p>
                                <p><i class="icon md-time mr-2"></i> {{ $event->start_time }}
                                    - {{ $event->end_time }}</p>
                                <div class="counter-label">
                                    <div class="counter counter-sm text-left">
                                        <div class="counter-number-group">
                                        <span class="counter-number">
                                            @if($event->number_of_seats - $event->bookings->count() > 0)
                                                {{ $event->number_of_seats - $event->bookings->where('status_is', 'Approved')->count() }}
                                            @else
                                                0
                                            @endif
                                            of {{ $event->number_of_seats }} <span class="counter-number-related">Seats Available</span>
                                        </span>

                                        </div>
                                    </div>
                            </div>
                            <div class="row mt-2 pb-2">
                                <div class="col-sm-12">
                                    <div class="progress progress-xs mb-10">
                                        <div class="progress-bar progress-bar-info bg-blue-600" aria-valuenow="{{ ((max($event->number_of_seats - $event->bookings->where('status_is', 'Approved')->count(), 0)) / $event->number_of_seats)*100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ((max($event->number_of_seats - $event->bookings->where('status_is', 'Approved')->count(), 0)) / $event->number_of_seats)*100 }}%" role="progressbar">
                                            <span class="sr-only">{{ ((max($event->number_of_seats - $event->bookings->where('status_is', 'Approved')->count(), 0)) / $event->number_of_seats)*100 }}%</span>
                                        </div>
                                    </div>
                                </div>
                                @if($event->status_is == 'Closed')
                                    <button type="button" disabled class="disabled btn btn-sm btn-danger btn-round text-uppercase ml-15"><i class="icon md-info-outline ml-1"></i>Event Closed
                                    </button>
                                @else
                                    @if(App\Booking::where(['user_id' => Auth::id(), 'event_id' => $event->id])->count() == 0)
                                        {!! Form::open(['route'=>'bookings.store']) !!}
                                        {{ Form::hidden('event',  $event->id)  }}
                                        {{ Form::hidden('user',  Auth::id()) }}
                                        <button type="submit" class="btn btn-sm btn-primary btn-round text-uppercase ml-15">Book Now<i class="icon md-chevron-right ml-1"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    @else

                                        <button type="button" disabled class="disabled btn btn-sm btn-primary btn-round text-uppercase ml-15"><i class="icon md-check ml-1"></i>Event Booked
                                        </button>
                                    @endif
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--<div class="card p-30">--}}
                        {{--<div class="card-block">--}}

                        {{--</div>--}}

                    {{--</div>--}}
                </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                    <div role="alert" class="alert dark alert-danger alert-icon" style="padding-left: 80px;">
                        <i class="icon md-calendar-close" aria-hidden="true" style="font-size: 3rem;"></i>
                        <h4>Oops!</h4>
                        <p>
                            Hmm! It seems we don't have any open events at this time, see below on what you have missed and check again soon!
                        </p>
                    </div> <br><br>
                </div>

                @foreach($events as $event)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="panel">
                        <span class="ribbon ribbon-badge ribbon-reverse ribbon-bottom ribbon-{{ $event->status_is=='Open' ? 'success' : 'danger'}}">
                            <span class="ribbon-inner">{{$event->status_is}}</span>
                        </span>

                            <div class="panel-heading">

                                <h3 class="panel-title">{{ $event->name }}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="counter counter-md text-left">
                                    <div class="counter-number-group mb-10">
                                        <span class="counter-number">R{{ $event->item->price }}</span>
                                    </div>
                                    <p class="card-text text-truncate mb-2"><i class="icon md-format-subject mr-2"></i>
                                        {{ $event->description }}
                                    </p>
                                    <p class="mb-2"><i class="icon md-calendar mr-2"></i> {{ $event->start_date->format('D, M jS Y') }}
                                        - {{ $event->end_date->format('D, M jS Y') }}</p>
                                    <p><i class="icon md-time mr-2"></i> {{ $event->start_time }}
                                        - {{ $event->end_time }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
    @endif
@endsection
