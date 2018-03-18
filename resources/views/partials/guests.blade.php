
<table class="table table-hover nowrap dt-responsive table-striped" id="bookings">
    <thead>
    <tr>
        <th>Reference</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Contact No.</th>
        <th>Date Booked</th>
        <th>Attachment</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookings as $booking)
        <tr id="booking-row-{{$booking->id}}">
            <td><a href="{{ route('bookings.show', $booking->id) }}">{{ $booking->reference }}</a></td>
            <td>{{ $booking->user->fullname }}</td>
            <td>{{ $booking->user->email }}</td>
            <td>{{ $booking->user->contactnumber }}</td>
            <td>{{ $booking->created_at->toDayDateTimeString() }}</td>
            <td>
                @if($booking->payment_img != null)
                    <a href="{{ Storage::url('booking/'.$booking->img_path .'/'.$booking->payment_img) }}" class="btn btn-info btn-sm btn-icon"data-toggle="tooltip" data-original-title="Proof of Payment"><i class="icon md-cloud-download"></i></a>
                @else
                    <button class="btn btn-flat btn-sm btn-icon disabled" data-toggle="tooltip" data-original-title="No Attachment"><i class="icon md-block"></i></button>
                @endif
            </td>
            <td>{{ $booking->status_is }}</td>
            <td>
                <div class="btn-group">
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

@section('deleteJS')
@stop