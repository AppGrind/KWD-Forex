@extends('layouts.backend')

@section('title')
    Create Event
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('events.create') }}
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
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2">
            <section class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new Event</h3>
                </div>
                @include('errors.forms')
                <div class="panel-body">
                    {!! Form::open(['url'=>'events', 'role'=>'form']) !!}
                    @include('backend.events._form', ['buttonText'=>'Save Event'])
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
@stop


@section('css')
  <!-- Bootstrap time Picker -->
  {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css') !!}
  <!-- bootstrap datepicker -->
  {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.3/datepicker.min.css') !!}

@stop

@section('js')
<!-- bootstrap time picker -->
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js') !!}
<!-- bootstrap date picker -->
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.3/datepicker.min.js') !!}
<script>
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });

    //Date picker
    $('.eventdatepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: '1d'
    });

    $('#start_date').datepicker().on('change', function(e){
        $('#end_date').removeAttr('disabled placeholder');
        $('#end_date').datepicker('setStartDate', $('#start_date').val());
        
        if($('#end_date').val() != ''){
            if(($('#start_date').datepicker('getDate') - $('#end_date').datepicker('getDate')) < 0 ){
                //Nothing to do here all is well
            }else{//NaN is returned if false
               $('#end_date').val($('#start_date').val());
            }
        }
        
    });

</script>
@stop