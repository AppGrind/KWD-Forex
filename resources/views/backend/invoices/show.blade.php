@extends('layouts.backend')

@section('title')
	Show Invoice
@stop


@section('breadcrumb')
	{{ Breadcrumbs::render('invoices.show', $invoice) }}
@stop

@section('actions')
    @include('partials.buttons')
@stop


@section('content')

    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <h3>
                        <img src="{{ asset('images/logo/KWD-FOREX-LOGO-black.png') }}" width="200px"></h3>
                        @include('partials.company_details')
                </div>
                <div class="col-lg-3 offset-lg-6 text-right">
                    <h4>Invoice Info</h4>
                    <p>
                        <a class="font-size-20" href="javascript:void(0)">#{{ $invoice->id }}</a>
                        <br> To:
                        <br>
                        <span class="font-size-20">{{ $invoice->user->fullname }}</span>
                    </p>
                    <address>
                        {{ $invoice->user->address }}
                        <br>
                        {{ $invoice->user->town }}
                        <br>
                        {{ $invoice->user->province }},
                        {{ $invoice->postalcode }}
                        <br>
                        <abbr title="Phone">P:</abbr>&nbsp;&nbsp;
                        {{ $invoice->user->contactnumber }}
                        <br>
                    </address>
                    <span>Invoice Date: {{ $invoice->created_at->format('F d, Y') }}</span>
                    <br>
                    <span>Invoice Due: {{ $invoice->created_at->addDays(7)->format('F d, Y') }}</span>
                    <br>
                    <span>Invoice Status: {{ $invoice->status_is }}</span>
                </div>
            </div>
            <div class="page-invoice-table table-responsive">
                <table class="table table-hover text-right">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Description</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Unit Cost</th>
                        <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice->items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->pivot->quantity }}</td>
                            <td>R{{ number_format($item->pivot->price,2,'.',',') }}</td>
                            <td>R{{ number_format($item->pivot->quantity * $item->pivot->price,2,'.',',') }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="4">SUBTOTAL</td>
                        <td class="total"></td>
                    </tr>
                    <tr>
                        <td colspan="4">VAT 14%</td>
                        <td class="total">R{{ number_format(0,2,'.',',') }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="grand total">GRAND TOTAL</td>
                        <td class="grand total">R{{ number_format($invoice->amount,2,'.',',') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right clearfix">
                <div class="float-right">
                    <p>Sub - Total amount:
                        <span>R{{ number_format($invoice->amount,2,'.',',') }}</span>
                    </p>
                    <p>VAT 14%:
                        <span>R{{ number_format(0,2,'.',',') }}</span>
                    </p>
                    <p class="page-invoice-amount">Grand Total:
                        <span>R{{ number_format($invoice->amount,2,'.',',') }}</span>
                    </p>
                </div>
            </div>
            <div class="text-right">
                <a class="btn btn-sm btn-animate btn-animate-side btn-info waves-effect waves-classic" href="{{ route('invoices.print', $invoice->id) }}">
                    <span><i class="icon md-print" aria-hidden="true"></i> Print</span>
                </a>
            </div>
        </div>
    </div>
@stop