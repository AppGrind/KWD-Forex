
	<div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
		{!! Form::label('name', 'Title:') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group {{ $errors->has('host') ? 'has-danger' : '' }}">
		{!! Form::label('host', 'Host:') !!}
		{!! Form::text('host', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group {{ $errors->has('address') ? 'has-danger' : '' }}">
		{!! Form::label('address', 'Street Address:') !!}
		{!! Form::text('address', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group {{ $errors->has('description') ? 'has-danger' : '' }}">
		{!! Form::label('description', 'Description:') !!}
		{!! Form::text('description', null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group {{ $errors->has('number_of_seats') ? 'has-danger' : '' }}">
		{!! Form::label('number_of_seats', 'Number Of Seats:') !!}
		{!! Form::number('number_of_seats', null, ['class'=>'form-control', 'placeholder' => '']) !!}
	</div>
	<div class="form-group {{ $errors->has('status_is') ? 'has-danger' : '' }}">
		{!! Form::label('status_is', 'Status:') !!}
		{!! Form::select('status_is', $statuses, null, ['class'=>'form-control']) !!}
	</div>
	<div class="form-group {{ $errors->has('item_id') ? 'has-danger' : '' }}">
		{!! Form::label('item_id', 'Item:') !!}
		{!! Form::select('item_id', $items, null, ['class'=>'form-control']) !!}
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group {{ $errors->has('start_date') ? 'has-danger' : '' }}">
				{!! Form::label('start_date', 'Start Date:') !!}
				{!! Form::text('start_date', null, ['class'=>'form-control eventdatepicker']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group {{ $errors->has('end_date') ? 'has-danger' : '' }}">
				{!! Form::label('end_date', 'End Date:') !!}
				{!! Form::text('end_date', null, ['class'=>'form-control eventdatepicker']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="bootstrap-timepicker">
					<div class="form-group {{ $errors->has('start_time') ? 'has-danger' : '' }}">
						{!! Form::label('start_time', 'Start Time:') !!}
						{!! Form::text('start_time', null, ['class'=>'form-control timepicker']) !!}
					</div>
				</div>
			</div>
		<div class="col-md-6">
			<div class="bootstrap-timepicker">
				<div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}">
					{!! Form::label('end_time', 'End Time:') !!}
					{!! Form::text('end_time', null, ['class'=>'form-control timepicker']) !!}
				</div>
			</div>
		</div>
	</div>
	<button class="btn btn-primary waves-effect waves-classic" type="submit"> {!! $buttonText !!}</button>
