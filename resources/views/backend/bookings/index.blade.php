@extends('layouts.backend')

@section('title')
    Bookings
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('bookings', $bookings) }}
@stop

@section('actions')
    @isset($button)
        @foreach($buttons as $btn)
            <a href="{{ url($btn['action']) }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="{{ $btn['title'] }}">
                <i class="{{ $btn['icon'] }}" aria-hidden="true"></i>
            </a>
        @endforeach
    @endisset
@stop

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <h3 class="panel-title with-border">
                All Events
            </h3>
        </div>

        <div class="panel-body">
                @if(count($bookings) > 0)
                <table id="bookings" class="nowrap dt-responsive table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Booked Event</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->reference }}</td>
                        <td>{{ App\Event::select('name')->where('id', $booking->event_id)->first()->name }}</td>
                        <td>{{ $booking->status_is }}</td>
                        <td>{{ $booking->created_at->toFormattedDateString() }}</td>
                        <td>
                        @if($booking->status_is == 'Paid')
                            <button disabled class="btn btn-success btn-sm"><i class="icon md-check mr-2"></i>{{$booking->status_is}} </button>
                        @elseif($booking->status_is == 'Declined')
                            <button disabled class="btn btn-danger btn-sm"> <i class="icon md-close mr-2"></i> {{$booking->status_is}}</button>
                        @else
                            <button disabled class="btn btn-default btn-sm"> <i class="icon md-time-countdown" style="animation-timing-function: cubic-bezier(0.68, -0.55, 0.27, 1.55);"></i> {{$booking->status_is}}</button>
                        @endif
                        </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
                @else
                <div class="panel panel-default">
                <div class="panel-body">
                <h2 class="text-gray text-center">Nothing to see here! :) Yet...</h2><p class="text-center">Why don't you come back after you've booked an event?</p>
                </div>
                </div>
                
                @endif
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
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
    <script>
        $(document).ready(function() {
            $('#bookings').DataTable({responsive: true});
        } );
    </script>
@stop