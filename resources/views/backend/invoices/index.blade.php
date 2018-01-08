@extends('layouts.backend')

@section('title')
	Invoices
@stop


@section('breadcrumb')
	{{ Breadcrumbs::render('invoices') }}
@stop

@section('actions')
	@include('partials.buttons')
@stop

@section('content')
	<div class="panel panel-bordered">

		<div class="panel-heading with-border">
			<h3 class="panel-title">All Invoices
			</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12">
					<table class="nowrap table table-hover table-striped table-condensed" id="invoices">
						<thead>
						<tr>
							<th>ID</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Created</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach($invoices as $invoice)
							<tr>
								<td class='hidden-350'>{{ $invoice->id }}</td>
								<td>R{{ $invoice->amount }}</td>
								<td>{{ $invoice->status_is }}</td>
								<td>{{ $invoice->created_at->toFormattedDateString() }}</td>
								<td>
									<div class="btn-group">
										<a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="View">
											<i class="icon md-eye"></i>	<span class="sr-only">View</span>
										</a>
										<a href="{{ route('invoices.print', $invoice->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip"
										   data-original-title="Edit">
											<i class="icon md-print"></i>	<span class="sr-only">Print</span>
										</a>
									</div>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
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
            $('#invoices').DataTable({responsive: true});
        } );
    </script>
@stop