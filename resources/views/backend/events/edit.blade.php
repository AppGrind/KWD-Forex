@extends('layouts.backend')

@section('title')
    Edit Event
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('events.edit', $event) }}
@stop

@section('actions')
    @include('partials.buttons')
@stop


@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg 2">
            <div class="panel panel-bordered">
                <div class="panel-heading with-border">
                    <h3 class="panel-title">Make Changes</h3>
                </div>
                <div class="panel-body">
                    @include('errors.forms')
                    {!! Form::model($event, ['method'=>'PATCH', 'url'=>'events/'.$event->id, 'role'=>'form']) !!}
                    @include('backend.events._form', ['buttonText'=>'Update changes'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
  <!-- Bootstrap time Picker -->
  {!! Html::style('plugins/timepicker/bootstrap-timepicker.min.css') !!}
  <!-- bootstrap datepicker -->
  {!! Html::style('plugins/datepicker/datepicker3.css') !!}

@stop

@section('javascript')
<!-- bootstrap time picker -->
{!! Html::script('plugins/timepicker/bootstrap-timepicker.min.js') !!}
<!-- bootstrap date picker -->
{!! Html::script('plugins/datepicker/bootstrap-datepicker.js') !!}
<script>
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });

    //Date picker
    $('.eventdatepicker').datepicker({
        format: 'yyyy/mm/dd',
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