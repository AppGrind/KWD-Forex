@extends('layouts.backend')

@section('title')
    Events
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('events') }}
@stop

@section('actions')
    @isset($buttons)
    @foreach($buttons as $btn)
        <a href="{{ url($btn['action']) }}" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="{{ $btn['title'] }}">
            <i class="{{ $btn['icon'] }}" aria-hidden="true"></i>
        </a>
    @endforeach
    @endisset
@stop

@section('content')

    <div class="panel panel-bordered">
        <div class="panel-heading">
            <h3 class="panel-title with-border">
                All Events
            </h3>
        </div>

        <div class="panel-body">
            @if(count($events)> 0)
                <table class="table table-hover table-striped w-full" id="events">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Host</th>
                        <th>Guests</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->name }} <i
                                        class="mr-3 icon md-circle float-right {{ ($event->status_is == 'Open') ? 'text-success' : 'text-danger'}}" data-toggle="tooltip" data-original-title="{{ $event->status_is }}"></i>
                            </td>
                            <td>{{ $event->host }}</td>
                            <td>{{ $bookings->where('event_id', $event->id)->count() }}
                                / {{ $event->number_of_seats }}</td>

                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('F j') }}
                                <strong>-</strong>
                                {{ \Carbon\Carbon::parse($event->end_date)->format('F j') }}</td>
                            <td>{{ $event->status_is }}</td>
                            <td>

                                <div class="btn-group" role="group">

                                        <a href="{{ url('attendees/'. $event->id . '/add') }}"
                                           rel="tooltip" class="btn btn-primary btn-sm btn-icon waves-effect waves-classic" data-toggle="tooltip" data-original-title="Add Guest">
                                            <i class="icon md-account-add"></i>
                                        </a>

                                    <a href="{{ url('events', $event->id) }}"
                                           rel="tooltip"
                                           class="btn btn-sm btn-primary btn-icon waves-effect waves-classic" data-toggle="tooltip" data-original-title="View Event">
                                            <i class="icon md-eye"></i>
                                        </a>
                                    <a href="{{ url('events/'.$event->id.'/edit') }}"
                                           rel="tooltip"
                                           class="btn btn-sm btn-primary btn-icon waves-effect waves-classic" data-toggle="tooltip" data-original-title="Edit Event"><i
                                                    class="icon md-edit"></i>
                                        </a>
                                    @if($event->status_is == 'Pending')
                                        {!! Form::open(['route' => ['events.publish', 'id' => $event->id], 'role'=>'form']) !!}
                                        <button type="submit"
                                               class="btn btn-sm btn-primary btn-icon waves-effect waves-classic" data-toggle="tooltip" data-original-title="Publish Event">
                                                <i class="icon md-mail-send"></i>
                                            </button>
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                                @if($event->status_is == 'Pending')
                                    {!! Btn::delete($event->id, url('events'), false, $event->name)!!}
                                @else
                                    {!! Btn::delete($event->id, url('events'), false,  $event->name, 'Any booking linked to this event will also be deleted!')!!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                    <h2 class="text-center text-muted">
                        <i class="icon md-info icon-2x"></i> <br>No events found.</h2>
            @endif
            </div>
    </div>

@endsection

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
            $('#events').DataTable({responsive: true});
        });
    </script>
@stop