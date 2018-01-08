@extends('layouts.pdf')

@section('content')
        <div class="panel">
            <div class="panel-body container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <h3 id="logo">
                            {{ Html::image('images/logo/KWD-FOREX-LOGO-black.png', '') }}</h3>
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
                        <span>Invoice Date: {{ $invoice->created_at->toFormattedDateString() }}</span>
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
                    Invoice was created on a computer and is valid without company the signature and stamp.
                </div>
            </div>
        </div>

@endsection

@section('styles')
    {!! Html::style("backend/global/css/bootstrap.min.css") !!}
    {!! Html::style("backend/assets/examples/css/pages/invoice.css") !!}
    <style>
        /*#project {*/
            /*float: left;*/
        /*}*/
        /*#project span {*/
            /*color: #D2AC67;*/
            /*text-align: right;*/
            /*width: 52px;*/
            /*margin-right: 10px;*/
            /*display: inline-block;*/
            /*font-size: 0.8em;*/
        /*}*/
        /*#company {*/
            /*float: right;*/
            /*text-align: right;*/
        /*}*/
        /*#project div,*/
        /*#company div {*/
            /*white-space: nowrap;*/
        /*}*/
        /*table {*/
            /*width: 100%;*/
            /*border-collapse: collapse;*/
            /*border-spacing: 0;*/
            /*margin-bottom: 20px;*/
        /*}*/
        /*table tr:nth-child(2n-1) td {*/
            /*background: #f1d2b6;*/
        /*}*/
        /*table th,*/
        /*table td {*/
            /*text-align: center;*/
        /*}*/
        /*table th {*/
            /*padding: 5px 20px;*/
            /*color: #D2AC67;*/
            /*border-bottom: 1px solid #D2AC67;*/
            /*white-space: nowrap;*/
            /*font-weight: normal;*/
        /*}*/
        /*table .service,*/
        /*table .desc {*/
            /*text-align: left;*/
        /*}*/
        /*table td {*/
            /*padding: 20px;*/
            /*text-align: right;*/
        /*}*/
        /*table td.service,*/
        /*table td.desc {*/
            /*vertical-align: top;*/
        /*}*/
        /*table td.unit,*/
        /*table td.qty,*/
        /*table td.total {*/
            /*font-size: 1.2em;*/
        /*}*/
        /*table td.grand {*/
            /*border-top: 1px solid #D2AC67;;*/
        /*}*/
        /*#notices .notice {*/
            /*color: #5D6975;*/
            /*font-size: 1.2em;*/
        /*}*/
                /*.clearfix:after {*/
            /*content: "";*/
            /*display: table;*/
            /*clear: both;*/
        /*}*/
    </style>
@stop