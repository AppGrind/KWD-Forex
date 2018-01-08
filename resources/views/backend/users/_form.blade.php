<div class="row" data-plugin="formMaterial">
    <div class="col-md-6 floating form-group {{ $errors->has('firstname') ? 'has-danger' : '' }}">
        <label class="floating-label" for="firstname">First Name</label>
        {!! Form::text('firstname', null, ['class'=>'form-control']) !!}
    </div>
    <div class="col-md-6 floating form-group {{ $errors->has('lastname') ? 'has-danger' : '' }}">
        <label class="floating-label" for="lastname">Last Name</label>
        {!! Form::text('lastname', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group floating {{ $errors->has('displayname') ? 'has-danger' : '' }}" data-plugin="formMaterial">
    <label class="floating-label" for="displayname">Display Name</label>
    {!! Form::text('displayname', null, ['class'=>'form-control', 'disabled']) !!}
    <div class="hint">This is unique to you, and is set in stone.</div>
</div>
<div class="form-group floating {{ $errors->has('contactnumber') ? 'has-danger' : '' }}" data-plugin="formMaterial">
    <label class="floating-label" for="contactnumber">Contact Number</label>
    {!! Form::text('contactnumber', null, ['class'=>'form-control']) !!}

</div>
<div class="form-group floating {{ $errors->has('address') ? 'has-danger' : '' }}" data-plugin="formMaterial">
    <label class="floating-label" for="address">Address</label>
    {!! Form::text('address', null, ['class'=>'form-control']) !!}

</div>
<div class="form-group floating {{ $errors->has('town') ? 'has-danger' : '' }}" data-plugin="formMaterial">
    <label class="floating-label" for="town">Town</label>
    {!! Form::text('town', null, ['class'=>'form-control']) !!}

</div>
<div class="floating row" data-plugin="formMaterial">
    <div class="col-md-7">
        <label class="form-group floating-label mb-2 {{ $errors->has('province') ? 'has-danger' : '' }}" for="province">Province</label>
        {!! Form::text('province', null, ['class'=>'form-control provinces typeahead']) !!}

    </div>
    <div class="col-md-5">
        <label class="form-group floating-label mb-2 {{ $errors->has('postalcode') ? 'has-danger' : '' }}" for="postalcode">Postal Code</label>
        {!! Form::number('postalcode', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group floating mt-4 {{ $errors->has('email') ? 'has-danger' : '' }}" data-plugin="formMaterial">
    <label class="floating-label" for="email">Email</label>
    {!! Form::email('email', null, ['class'=>'form-control', 'disabled']) !!}
    <div class="hint">This is also set in stone.</div>

</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>

<br>