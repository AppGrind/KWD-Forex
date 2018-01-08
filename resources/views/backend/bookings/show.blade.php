@extends('layouts.backend')

@section('title')
    Booking #{{ $booking->reference }}
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('bookings.show', $booking) }}
@stop

@section('actions')
    @include('partials.buttons')
@stop

@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-bordered">
                <span class="ribbon ribbon-reverse ribbon-{{ $booking->status_is=='Open' ? 'success' : 'danger'}}">
                    <span class="ribbon-inner">{{$booking->status_is}}</span>
                </span>
                <div class="panel-heading">
                    <h3 class="panel-title with-border">
                        #{{ $booking->reference }} <small>@
                            R{{number_format($booking->event->item->price, 2, '.', '')}}</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <p><i class="icon md-calendar-check mr-2"></i>Event Booked <strong>{{ $booking->event->name }}</strong></p>
                    <p><i class="icon md-calendar-alt mr-2"></i>Event Dates <strong>{{ $booking->event->start_date->toFormattedDateString() }}</strong> to <strong>{{ $booking->event->end_date->toFormattedDateString() }}</strong></p>
                    <p><i class="icon md-time mr-2"></i>Event Duration <strong>{{ $booking->event->start_time }}</strong> to <strong>{{ $booking->event->end_time }}</strong></p>
                    <p><i class="icon md-attachment mr-2"></i>
                        @if($booking->payment_img != null)
                        <a href="{{ Storage::url('booking/'.$booking->img_path .'/'.$booking->payment_img) }}" class="bold btn p-0 btn-flat" id="download_link" data-toggle="tooltip" data-original-title="Proof of Payment">Download Attachment</a>
                        @else
                            <span id="download_link">Please upload attachment</span>
                        @endif
                    </p>
                    <p class="text-muted text-lg-right  text-md-right">Booking Created: {{ $booking->created_at->format('l, F jS Y h:i:s A') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7">

            <div class="panel panel-bordered">
                <span class="ribbon ribbon-reverse ribbon-{{ $booking->payment_img != null ? 'success' : 'danger'}}">
                    <span class="ribbon-inner">{{ $booking->payment_img !=null ? 'Has Attachment' : 'No Attachment'}}</span>
                </span>
                <div class="panel-heading">
                    <h3 class="panel-title with-border">
                    Attachment <small>Proof of Payment</small>
                    </h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['method'=> 'post',  'url' => '/bookings/'. $booking->id .'/attachment/upload', 'id' => '#upload-form' , 'class' => 'form mb-0 dropzone', 'novalidate' => 'novalidate', 'files' => true, 'enctype'=>'multipart/form-data']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    {!! Html::style("https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/basic.min.css") !!}
    {!! Html::style("https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css") !!}
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
    {!! Html::script("https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js") !!}
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        Dropzone.options.uploadForm = {}

        $(document).ready(function(){

            $('.dropzone').dropzone({
                dictDefaultMessage: 'Click or Drop file here, to upload. (.jpg, .jpeg, .png, .gif, .pdf)',
                acceptedFiles: 'image/*, application/pdf',
                maxFilesize: 2,
                maxFiles : 1,
                init: function() {
                    this.on("success", function(file, response) {
                        toastr.success('Attachment uploaded successfully!');
                        $('#download_link').attr('disabled', 'disabled').addClass('disabled').text('Link updated, Please refresh page');
                    }),
                    this.on("error", function(file, response, errorMessage) {
                        console.log('file '+file + ' Response: ' + response + ' ErrorMessage: ' + errorMessage );
                        toastr.error(response, 'Could not upload attachment');
                    }),
                    this.on("info", function(file, response) {
                        toastr.info(response);
                    })
                }
            });
        });
    </script>
@stop