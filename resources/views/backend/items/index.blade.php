@extends('layouts.backend')

@section('title')
	Items
@stop


@section('breadcrumb')
	{{ Breadcrumbs::render('items') }}
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
		<div class="panel-header with-border">
			<h3 class="panel-title">All Items
			</h3>
		</div>
			<table class="nowrap table table-hover table-striped table-condensed" id="items">
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
	</div>

@endsection

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
            $('#items').DataTable({responsive: true});
        } );
    </script>
@stop