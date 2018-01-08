@extends('layouts.backend')

@section('title')
    Add Guest
@stop


@section('breadcrumb')
    {{ Breadcrumbs::render('bookings.create') }}
@stop

@section('actions')
    @include('partials.buttons')
@stop


@section('content')


    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
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

        </div>
    </div>



    <div class="page-header">
        <div class="page-header-actions" style="right: 0;">
            <a href="{{ route('guests.print', $event->id) }}" class="btn btn-sm btn-icon btn-warning btn-round waves-effect waves-classic" data-toggle="tooltip" data-original-title="Print Guest List">
                <i class="icon md-print" aria-hidden="true"></i>
            </a>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title with-border">
                        Add Guest Details
                    </h3>
                </div>
                <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                        <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#new" aria-controls="messages" role="tab">New User</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#existing" aria-controls="messages" role="tab">Existing User</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane animation-slide-left p-10" id="new" role="tabpanel">
                            <div class="alert-warning dark-alt alert-dismissable alert-alt alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Please select "Existing User" if the user already exists on the system.
                            </div>
                            @include('errors.forms')
                            <form  method="POST" action="{{ route('guest.save', $event->id) }}" role="form" autocomplete="on">
                            {{ csrf_field() }}

                                {!! Form::hidden('existing_user', 'false') !!}
                                <div class="form-group row floating" data-plugin="formMaterial">
                                    <div class="col-md-6">
                                        <label class="floating-label" for="firstname">First Name</label>
                                        <input type="text" class="form-control empty {{ $errors->has('firstname') ? 'has-danger' : '' }}" value="{{ old('firstname') }}" id="firstname" name="firstname">
                                        @if ($errors->has('firstname'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="floating-label" for="lastname">Last Name</label>
                                        <input type="text" class="form-control empty {{ $errors->has('lastname') ? 'has-danger' : '' }}" value="{{ old('lastname') }}" id="lastname" name="lastname">
                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group floating" data-plugin="formMaterial">
                                    <label class="floating-label" for="contactnumber">Contact Number</label>
                                    <input type="text" class="form-control empty {{ $errors->has('contactnumber') ? 'has-danger' : '' }}" value="{{ old('contactnumber') }}" id="contactnumber" name="contactnumber">
                                    @if ($errors->has('contactnumber'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contacnumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group floating" data-plugin="formMaterial">
                                    <label class="floating-label" for="address">Address</label>
                                    <input type="text" class="form-control empty {{ $errors->has('address') ? 'has-danger' : '' }}" value="{{ old('address') }}" id="address" name="address">
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group floating" data-plugin="formMaterial">
                                    <label class="floating-label" for="town">Town</label>
                                    <input type="text" class="form-control empty {{ $errors->has('town') ? 'has-danger' : '' }}" value="{{ old('town') }}" id="town" name="town">
                                    @if ($errors->has('town'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('town') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group floating row" data-plugin="formMaterial">
                                    <div class="col-md-7">
                                        <label class="floating-label" for="province">Province</label>
                                        <input type="text" class="form-control empty provinces typeahead  {{ $errors->has('province') ? 'has-danger' : '' }}" value="{{ old('province') }}" id="province" name="province">
                                        @if ($errors->has('province'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('province') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-5">
                                        <label class="floating-label" for="postalcode">Postal Code</label>
                                        <input type="number" class="form-control empty postalcode {{ $errors->has('postalcode') ? 'has-danger' : '' }}" value="{{ old('postalcode') }}" id="postalcode" name="postalcode">
                                        @if ($errors->has('postalcode'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('postalcode') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group floating" data-plugin="formMaterial">
                                    <label class="floating-label" for="email">Email</label>
                                    <input type="email" class="form-control empty {{ $errors->has('email') ? 'has-danger' : '' }}" value="{{ old('email') }}" id="email" name="email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Add Guest</button>
                            </form>
                        </div>
                        <div class="tab-pane animation-slide-left p-10" id="existing" role="tabpanel">

                            <div class="alert-warning dark-alt alert-dismissable alert-alt alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Can't find the user's email? They're probably not in the system, add them by clicking "New user"
                            </div>
                            {!! Form::open(['route'=>['guest.save', $event->id], 'role'=>'form', 'method' => 'post']) !!}
                                {{ csrf_field() }}
                                {!! Form::hidden('existing_user', 'true') !!}
                                <div class="form-group">
                                    <label for="user">Search/Select Guest Email Address</label>
                                    {!! Form::select('user_id', $guests, null, ['class' => 'form-control', 'style' => 'width: 100%', 'data-plugin'=>'select2']) !!}
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-md btn-primary" type="submit">Add Guest</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="panel panel-bordered">
                <div class="panel-heading with-border">
                    <h3 class="panel-title">
                        Guest List
                    </h3>
                </div>
                <div class="pt-20">
                    @include('partials.guests')
                </div>
            </div>
        </div>
    </div>

@stop


@section('css')
  <!-- bootstrap datepicker -->
  {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css') !!}
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
  <style>
      .select2-container--default .select2-selection--single {
          border: 1px solid #e0e0e0;
          border-radius: .215rem;
          padding: .429rem 1.072rem;
      }

      .select2-container .select2-selection--single {
          height: 40px;
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 38px;
      }
  </style>
@stop

@section('js')

    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap4.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap4.min.js') }}
<!-- Select2 -->
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js') !!}
<script>

    //Select2 Elements
    $(".select2").select2();
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