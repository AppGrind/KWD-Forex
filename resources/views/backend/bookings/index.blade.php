@extends('layouts.backend')

@section('title')
    Bookings
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('bookings', $bookings) }}
@stop

@section('actions')
    @include('partials.buttons')
@stop

@section('content')

<div class="content-wrapper">
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <h3 class="panel-title with-border">
                All Bookings
            </h3>
        </div>

        <div class="pt-4">
                @if(count($bookings) > 0)
                <table id="bookings" class="nowrap dt-responsive table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Booked Event</th>
                            @if(Auth::user()->hasRole('admin'))
                            <th>User</th>
                            @endif
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->reference }}</td>
                        <td>{{ $booking->event->name }}</td>
                        @if(Auth::user()->hasRole('admin'))
                        <td><a href="{{ url('users/'.$booking->user->id) }}"><i class="icon md-link mr-2"></i>{{ $booking->user->fullname }}</a></td>
                        @endif
                        <td>{{ $booking->status_is }}</td>
                        <td>{{ $booking->created_at->toFormattedDateString() }}</td>
                        <td>

                            <div class="btn-group">
                                @if(Auth::user()->hasRole('admin'))
                                @if($booking->status_is == 'Pending')
                                    @if($booking->payment_img != null)
                                        <a href="{{ route('booking.approve', $booking->id) }}"
                                           class="btn btn-info btn-icon btn-sm"
                                           data-toggle="tooltip"
                                           data-original-title="Approve this">
                                            <i class="icon md-thumb-up"></i>
                                        </a>
                                        {!! Form::open(['method'=>'post', 'url' => route('booking.decline', $booking->id), 'class' => 'inline-form', 'id' => 'decline-form-'.$booking->id]) !!}
                                        <input type="hidden" name="reason-{{ $booking->id }}" id="reason-{{ $booking->id }}" value="Booking declined by {{ Auth::user()->fullname }}. Reason not specified, please contact {{ config('app.name') }}">
                                        <button type="button"
                                                class="btn btn-info btn-icon btn-sm decline-btn"
                                                data-toggle="tooltip"
                                                data-original-title="Decline this"
                                                data-resource-id="{{ $booking->id }}">
                                            <i class="icon md-thumb-down"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    @else
                                        <button type="button" class="btn btn-info btn-icon btn-sm disabled blue-grey-100"
                                                data-toggle="tooltip"
                                                data-original-title="Pending attachment"><i class="icon md-time-countdown"></i>!</button>
                                    @endif
                                @elseif($booking->status_is == 'Declined')
                                    <a href="{{ route('booking.approve', $booking->id) }}"
                                       class="btn btn-info btn-icon btn-sm"
                                       data-toggle="tooltip"
                                       data-original-title="Approve this">
                                        <i class="icon md-thumb-up"></i>
                                    </a>
                                @elseif($booking->status_is == 'Paid')
                                    <a href="javascript:;" class="white-text"><i class="fa ion ion-checkmark-round"></i>  Approved!</a>
                                @endif
                                @endif
                                <a href="{{ url('bookings/'.$booking->id) }}" class="btn btn-info btn-icon btn-sm" data-toggle="tooltip" data-original-title="View"><i class="icon md-eye"></i></a>
                            </div>
                        @if(Auth::user()->hasRole('admin'))
                            {!! Btn::delete($booking->id, url('bookings'), false, $booking->user->fullname, 'btn-icon' , 'Are you sure you want to remove this guest? (' . $booking->user->fullname . ')', 'Remove')!!}
                        @endif
                        </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
                @else
                <h2 class="text-center">Nothing found!</h2><p class="text-center">You have not made any bookings yet.</p>
                
                @endif
              </div>
            <div class="panel-footer mt-40">
                {{ $bookings->links() }}
            </div>
    </div>
  </div>


<div class="modal fade" id="decline-reason">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa ion ion-ios-close"></i></span></button>
                <h4 class="modal-title">Decline Reason</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('reason') !!}
                    {!! Form::text('reason', null, ['class'=>'form-control', 'data-validate'=>'required']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" id="close-modal">Close</button>
                <button type="submit" id="save-reason" class="btn btn-md btn-danger"><i
                            class="ion ion-ios-cloud-upload-outline"></i> Save Reason
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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
    </style>
@stop

@section('js')
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap4.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap4.min.js') }}
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