@extends('layouts.backend')

@section('title')
    Show Event
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('events.show', $event) }}
@stop

@section('actions')
    @if(Gate::allows('admin'))
    @include('partials.buttons')
    @if($event->status_is == 'Pending')
        {!! Btn::delete($event->id, url('/events'), false, $event->name, 'btn-icon btn-round')!!}
    @else
        {!! Btn::delete($event->id, url('/events'), false, $event->name, 'btn-icon btn-round', 'All bookings linked to this event will also be deleted!')!!}
    @endif
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
    @if(Gate::allows('admin'))
    <div class="page-header">
        <div class="page-header-actions" style="right: 0;">
            @if($event->status_is == "Open")
            <a href="{{ route('guest.add', $event->id) }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="Add Guest">
                <i class="icon md-account-add" aria-hidden="true"></i>
            </a>
            @endif
            <a href="{{ route('guests.print', $event->id) }}" class="btn btn-sm btn-icon btn-warning btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="Print Guest List">
                <i class="icon md-print" aria-hidden="true"></i>
            </a>
        </div>
    </div>


    <div class="panel panel-bordered">
        <div class="panel-heading">
            <h3 class="panel-title with-border">Guest List</h3>
        </div>

        <div class="panel-body">
            @include('partials.guests')
        </div>
    </div>
    @endif
@stop

@section('css')
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.min.css') }}
    {{ Html::style('https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css') }}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/jquery.dataTables.min.css') }}
    <style>
        table.dataTable thead th, table.dataTable thead td,  table.dataTable td {
            padding: 10px 18px;
            border-bottom: 0px solid #e0e0e0;
        }
        table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before,
        table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after
        {content:''}
        #bookings_wrapper .row, #bookings_wrapper table{ width:100% !important;}
    </style>
@stop

@section('js')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    <script>
        $(document).ready(function () {
            $('#bookings').DataTable({responsive: true, paging: false});

            var $declineReason = $('#decline-reason');
            $('.decline-btn').on('click', function(e){
                window.$resource = $(this).attr('data-resource-id');
                $declineReason.modal({});
            })

            $('#save-reason').on('click', function(e){
                $reason = $('#reason-'+window.$resource);

                $reason.val( $('#reason').val());
                if(!$.trim($reason.val())){
                    $('#reason').parents('div.form-group').addClass('has-danger');
                    $('#reason').val('');
                    $('#reason').attr('placeholder', 'Reason cannot be blank!');
                    return false;
                }

                $reason.val('{{ Auth::user()->fullname }} said: ' + $reason.val());
                $('#decline-form-'+window.$resource).submit();
                $declineReason.modal('hide')

            });

            $('#close-modal').on('click', function(){
                $declineReason.modal('hide')
            });
        });
    </script>
@stop
