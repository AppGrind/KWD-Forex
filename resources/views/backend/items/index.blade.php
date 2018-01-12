@extends('layouts.backend')

@section('title')
	Items
@stop


@section('breadcrumb')
	{{ Breadcrumbs::render('items') }}
@stop

@section('actions')
	@include('partials.buttons')
@stop

@section('content')
    <div class="panel panel-bordered">
        <div class="panel-heading mb-10">
            <h3 class="panel-title with-border">All Items
			</h3>
		</div>
			<table class="nowrap dt-responsive table table-hover table-striped" id="items">
				<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>
				@foreach($items as $item)
					<tr>
						<td class='hidden-350'>{{ $item->id }}</td>
						<td>{{ $item->name }}</td>
						<td>R{{ $item->price }}</td>
						<td>{{ $item->category_is }}</td>
						<td>{{ $item->status_is }}</td>
						<td>
							<div class="btn-group">
							<a href="{{ url('items', $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="View Item">
								<i class="icon md-eye"></i>
							</a>
							<a href="{{ url('items/'.$item->id.'/edit') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Edit Item">
								<i class="icon md-edit"></i>
							</a></div>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>

        <div class="panel-footer mt-40">
            {{ $items->links() }}
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
        $(document).ready(function() {
            $('#items').DataTable({responsive: true, paging: false});
        } );
    </script>
@stop