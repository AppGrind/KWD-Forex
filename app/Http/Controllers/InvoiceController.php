<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceFormRequest;
use Auth;
use Gate;
use PDF;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('su', ['except' => ['index', 'show', 'printInvoice']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Auth::user()->is_verified) {
            return redirect('/verification');
        }

        // Get all invoices if admin
        if(Gate::allows('admin')){
            $invoices = Invoice::all();
        }else{
            $invoices = Invoice::where('user_id', Auth::id())->get();
        }

        return view('backend.invoices.index', compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {

        if(Gate::denies('owner-or-admin', $invoice->user_id)){
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        $listBtn = ['title'=>'All Invoices', 'action' => 'invoices', 'icon' => 'icon md-format-list-bulleted'];
        $buttons =[];
        array_push($buttons,  $listBtn);

        // Show invoice of $id
        $user = Auth::user();


        return view('backend.invoices.show', compact('invoice','user', 'buttons'));
    }


    // Generate PDF invoice
    public function print(Invoice $invoice)
    {

        if(Gate::denies('owner-or-admin', $invoice->user_id)){
            flash('Unauthorized access attempt!', 'error');
            return redirect('/dashboard');
        }

        // Get user info from Session
        $user = Auth::user();

        $data=['invoice'=>$invoice, 'user'=>$user];

        $pdf = PDF::loadView('pdf.invoice', $data);

        return $pdf->download($invoice->created_at->format('YmdHis').'-invoice-'.$invoice->id.'.pdf');
    }
}
