@extends('layouts.backend')

@section('title')
    Dashboard
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@stop



@section('content')
    <div class="row" data-plugin="matchHeight" data-by-row="true">
        @foreach($events as $event)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card card-block p-30">
                <span class="ribbon ribbon-reverse ribbon-{{ $event->status_is=='Open' ? 'success' : 'danger'}}">
                    <span class="ribbon-inner">{{$event->status_is}}</span>
                </span>
                <div class="counter counter-md text-left">
                    <div class="counter-label text-uppercase mb-5">{{ $event->name }}</div>
                    <div class="counter-number-group mb-10">
                        <span class="counter-number">R{{ $event->item->price }}</span>
                    </div>
                    <p class="card-text">
                        {{ $event->description }}
                    </p>
                    <div class="counter-label">
                        <div class="counter counter-sm text-left">
                            <div class="counter-number-group">
                                <span class="counter-number">{{ $event->number_of_seats - $event->bookings->count() }} of {{ $event->number_of_seats }}</span>
                                <span class="counter-number-related">Seats Available</span>
                            </div>
                        </div>
                        <div class="progress progress-xs mb-10">
                            <div class="progress-bar progress-bar-info bg-blue-600" aria-valuenow="{{ ($event->number_of_seats - $event->bookings->count())*10 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($event->number_of_seats - $event->bookings->count())*10 }}%" role="progressbar">
                                <span class="sr-only">{{ ($event->number_of_seats - $event->bookings->count())*10 }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2 pb-2">
                    <div class="col-sm-12">
                        @if(App\Booking::where(['user_id' => Auth::id(), 'event_id' => $event->id])->count() == 0)
                        {!! Form::open(['route'=>'bookings.store']) !!}
                        {{ Form::hidden('event',  $event->id)  }}
                        {{ Form::hidden('user',  Auth::id()) }}
                        <button type="submit" class="btn btn-sm btn-primary btn-round text-uppercase">Book Now<i class="icon md-chevron-right ml-1"></i>
                        </button>
                        {!! Form::close() !!}
                        @else

                            <button type="submit" disabled class="disabled btn btn-sm btn-primary btn-round text-uppercase"><i class="icon md-check mr-1"></i>Event Booked
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
