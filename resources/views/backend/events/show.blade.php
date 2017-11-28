@extends('layouts.backend')

@section('title')
    Show Event
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('events.show', $event) }}
@stop

@section('actions')
    @isset($buttons)
        @foreach($buttons as $btn)
            <a href="{{ url($btn['action']) }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="{{ $btn['title'] }}">
                <i class="{{ $btn['icon'] }}" aria-hidden="true"></i>
            </a>
        @endforeach
    @endisset
    @if($event->status_is == 'Pending')
        {!! Btn::delete($event->id, url('/events'), false, $event->name, 'btn-icon btn-round')!!}
    @else
        {!! Btn::delete($event->id, url('/events'), false, $event->name, 'btn-icon btn-round', 'Any booking linked to this event will also be deleted!')!!}
    @endif
@stop

@section('content')

    <div class="panel panel-bordered">
        <span class="ribbon ribbon-reverse ribbon-{{ $event->status_is=='Open' ? 'success' : 'danger'}}">
            <span class="ribbon-inner">{{$event->status_is}}</span>
        </span>
        <div class="panel-heading">
            <h3 class="panel-title with-border">
                {{ $event->name }} <small>@
                    R{{number_format($event->item->price, 2, '.', '')}}</small>
            </h3>
        </div>
        <div class="panel-body">
            <p><i class="icon md-calendar mr-2"></i> {{ $event->start_date->format('D, M jS Y') }}
                - {{ $event->end_date->format('D, M jS Y') }}</p>
            <p><i class="icon md-time mr-2"></i> {{ $event->start_time }}
                - {{ $event->end_time }}</p>
            <p><i class="icon md-account mr-2"></i> {{ $event->host }}</p>
            <p><i class="icon md-map mr-2"></i> {{ $event->address }}</p>
            <p class="event-description"><i
                        class="icon md-format-subject mr-2"></i> {{ $event->description }}</p>
            <p class="text-muted text-lg-right  text-md-right">Last updated: {{ $event->updated_at->format('l, F jS Y h:i:s A') }}</p>
        </div>
    </div>
    <div class="page-header">
        <div class="page-header-actions" style="right: 0;">
            @if($event->status_is == "Open")
            <a href="{{ url('attendees/'. $event->id . '/add') }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="Add Guest">
                <i class="icon md-account-add" aria-hidden="true"></i>
            </a>
            @endif
            <a href="{{ url('attendees/'. $event->id .'/print') }}" class="btn btn-sm btn-icon btn-warning btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="Print Guest List">
                <i class="icon md-print" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <h3 class="panel-title with-border">Guest Bookings</h3>
        </div>

        <div class="panel-body table-responsive">

            <table class="table table-hover nowrap dt-responsive table-striped" id="bookings">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact No.</th>
                    <th>Date Booked</th>
                    <th>Proof of Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr id="booking-row-{{$booking->id}}">
                        <td>{{ $booking->user->firstname }} {{ $booking->user->lastname }}</td>
                        <td>{{ $booking->user->email }}</td>
                        <td>{{ $booking->user->cell }}</td>
                        <td>{{ $booking->created_at->toDayDateTimeString() }}</td>
                        <td>
                            @if($booking->proof_of_payment == null)
                                <button id="booking-{{ $booking->id }}" type="button"
                                        value="{{ $booking->event_id }}"
                                        data-userid="{{ $booking->user_id }}"
                                        data-fullname="{{ $booking->user->firstname }} {{ $booking->user->lastname }}"
                                        data-toggle="modal" data-target="#proof-modal"
                                        class="btn btn-success btn-sm btn-social btn-proof"><i
                                            class="fa ion ion-social-usd"></i>Upload Proof
                                </button>
                            @else
                                <button class="btn btn-default btn-sm btn-proof" type="button"
                                        data-toggle="collapse"
                                        data-target="#collapse-{{ $booking->reference }}"
                                        aria-expanded="false"
                                        aria-controls="collapse-{{ $booking->reference }}"><i
                                            class="fa ion ion-android-attach"></i>
                                    Proof of Payment
                                </button>
                                <div class="collapse" id="collapse-{{ $booking->reference }}">
                                    <a target="_blank"
                                       href="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}">
                                        <img class="elevatezoom" style="width: 100%;height: auto"
                                             src="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}"
                                             data-zoom-image="data:{{ $booking->mime_type }};base64,{{base64_encode($booking->proof_of_payment)}}"/></a>
                                </div>
                            @endif
                        </td>
                        <td>{{ $booking->status_is }}</td>
                        <td>


                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default">Choose Action</button>
                                <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    @if($booking->status_is == 'Pending')
                                        @if($booking->proof_of_payment != null)
                                            <li>
                                                <a href="{{ url('booking/'.$booking->id.'/approve') }}"

                                                   rel="tooltip"
                                                   title="Edit" id="approve-{{ $booking->id }}">
                                                    <i class="fa ion ion-checkmark-round green-text"></i> Approve
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('booking/'.$booking->id.'/decline') }}"

                                                   rel="tooltip"
                                                   title="Edit">
                                                    <i class="fa ion ion-close-round materialize-red-text"></i> Decline
                                                </a>
                                            </li>
                                        @else
                                            <li class="disabled orange"><a href="javascript:;" class="white-text"><i class="fa ion ion-clock"></i>No action possible!</a></li>
                                        @endif
                                    @elseif($booking->status_is == 'Paid')
                                        <li class="disabled green"><a href="javascript:;" class="white-text"><i class="fa ion ion-checkmark-round"></i>  Approved!</a></li>
                                    @endif
                                </ul>
                            </div>
                            @if(Auth::user()->hasRole('admin'))
                                {!! Btn::delete($booking->id, url('bookings'), false, '' , 'Are you sure you want to remove ' . $booking->user->firstname . '?')!!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="proof-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa ion ion-ios-close"></i></span></button>
                    <h4 class="modal-title"></h4>
                </div>
                {!! Form::open(['url' => 'imageUploadForm', 'id' => '#proof-form' , 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::file('image', ['class' => 'inputfile well', 'accept' => '.jpeg, .jpg, .png', 'style' => 'width: 100%']) !!}
                    </div>
                    <div class="form-group" hidden>
                        {!! Form::label('eventId') !!}
                        {!! Form::hidden('eventId', $event->id, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group" hidden>
                        {!! Form::label('userId') !!}
                        {!! Form::hidden('userId', Auth::id(), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="upload-proof" class="btn btn-md btn-danger"><i
                                class="ion ion-ios-cloud-upload-outline"></i> Upload selected file
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    <!-- jQuery Knob -->
    {!! Html::script('plugins/knob/jquery.knob.js') !!}
    <script>
        $(function () {
            /* jQueryKnob */
            $(".knob").knob({
                /*change : function (value) {
                 //console.log("change : " + value);
                 },
                 release : function (value) {
                 console.log("release : " + value);
                 },
                 cancel : function () {
                 console.log("cancel : " + this.value);
                 },*/
                draw: function () {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        var a = this.angle(this.cv) // Angle
                            ,
                            sa = this.startAngle // Previous start angle
                            ,
                            sat = this.startAngle // Start angle
                            ,
                            ea // Previous end angle
                            , eat = sat + a // End angle
                            ,
                            r = true;

                        this.g.lineWidth = this.lineWidth;

                        this.o.cursor &&
                        (sat = eat - 0.3) &&
                        (eat = eat + 0.3);

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value);
                            this.o.cursor &&
                            (sa = ea - 0.3) &&
                            (ea = ea + 0.3);
                            this.g.beginPath();
                            this.g.strokeStyle = this.previousColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });
            /* END JQUERY KNOB */
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.btn-proof').on('click', function (e) {
                var booking = $(this);
                $('.modal-title').html('Upload Proof of Payment for <strong>' + booking.attr('data-fullname') + '</strong>');
                $('#eventId').val(booking.attr('value'));
                $('#userId').val(booking.attr('data-userid'));
            });

            $('.elevatezoom').elevateZoom({
                zoomType: 'lens',
            });
            $('#bookings').DataTable();
        });
    </script>
@stop