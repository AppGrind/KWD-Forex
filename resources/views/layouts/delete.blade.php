@if($size)
    <a class="btn btn-danger text-white waves-effect waves-classic btn-delete-{{ $id }} {{ $class }} btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="icon md-delete"></i> Delete</a>
@else
    <a class="btn btn-danger btn-icon waves-effect waves-classic text-white btn-delete-{{ $id }} {{ $class }} btn-sm"  data-toggle="tooltip" data-original-title="Delete"><i class="icon md-delete"></i></a>
@endif

{!! Form::open(['url' => $url.'/'.$id, 'id' => 'delete-form-'.$id, 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
<input type="hidden" name="_method" value="DELETE">
@php $name = empty($name) ? 'item' : $name @endphp
{!! Form::close() !!}

@section('deleteJS')
<script> 
jQuery(document).ready(function(){

    jQuery('.btn-delete-{{ $id }}').on('click', function(e){
        e.preventDefault();
        swal({
            title: 'Caution!',
            text: '{{ $message }}',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete this!',
            closeOnConfirm: false,
            closeOnCancel: false
        },        
        function(isConfirm){
            if(isConfirm){
                jQuery('#delete-form-{{$id}}').submit();
            }else{
                swal('Cancelled', 'Operation aborted', 'error');
            }
        });
    });
});
</script>
@stop