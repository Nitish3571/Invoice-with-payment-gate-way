<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(){
      $invoiceDetails = Invoice::all();
      return view('content.invoice.invoice_list' , compact('invoiceDetails'));
    }

    public function create(){
      $nextInvoiceNumber = DB::table('invoices')->max('invoice_no') + 1;
      return view('content.invoice.invoice_create' , compact('nextInvoiceNumber'));
    }

    public function view(Request $request){
      $id = $request->id;

      $invoiceDetails = Invoice::findOrFail($id);
      $invoiceItems = InvoiceItem::where('invoice_id' , $id)->get();

      return view('content.invoice.invoice_view', compact('invoiceDetails', 'invoiceItems'));
  }

    public function edit(Request $request){
      $id = $request->id;

      $invoiceDetails = Invoice::findOrFail($id);
      $invoiceItems = InvoiceItem::where('invoice_id' , $id)->get();

      return view('content.invoice.invoice_edit', compact('invoiceDetails', 'invoiceItems'));
  }

    public function store(Request $request)
    {
      // dd($request);

      $request->validate([
        'invoice_no' => 'required|string|max:255',
        'date' => 'required|date',
        'placeSupply' => 'required|string|max:255',
        'billName' => 'required|string',
        'billingAddress' => 'required|string',
        'billingPhoneNo' => 'required|string',
        'billingEmail' => 'required|string',
        'shipName' => 'required|string',
        'shipAddress' => 'required|string',
        'shipPhoneNo' => 'required|string',
        'shipEmail' => 'nullable|string',
        'emailAddress' => 'nullable|string',
        'items.*' => 'required|string|max:255',
        'description.*' => 'nullable|string|max:255',
        'quantities.*' => 'required|numeric|min:1',
        'unit_rates.*' => 'required|numeric|min:0',
        'cgst.*' => 'required|numeric|min:0',
        'sgst.*' => 'required|numeric|min:0',
        'igst.*' => 'required|numeric|min:0',
        'amounts.*' => 'required|numeric|min:0',
        'subTotal' => 'required|numeric|min:0',
        'discountInput' => 'required|numeric|min:0',
        'discountValue' => 'required|numeric|min:0',
        'netAmount' => 'required|numeric|min:0',
    ]);


    $date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');

    $invoice = Invoice::create([
      'invoice_no' => $request->invoice_no,
      'date' => $date,
      'placeSupply' => $request->placeSupply,
      'billName' => $request->billName,
      'billingAddress' => $request->billingAddress,
      'billingPhoneNo' => $request->billingPhoneNo,
      'billingEmail' => $request->billingEmail,
      'shipName' => $request->shipName,
      'shipAddress' => $request->shipAddress,
      'shipPhoneNo' => $request->shipPhoneNo,
      'shipEmail' => $request->shipEmail,
      'subTotal' => $request->subTotal,
      'discountInput' => $request->discountInput,
      'discountValue' => $request->discountValue,
      'netAmount' => $request->netAmount,

  ]);
  // dd($request->all());
  foreach ($request->items as $key => $item) {
    // dd($request->items);
    $description = $request->description[$key] ?? 'No description'; // Default description if not provided or null
    // dd($description);
    if (!empty($description)) {
        $invoice->items()->create([
            'item' => $item,
            'description' => $description,
            'quantity' => $request->quantities[$key],
            'unit_rate' => $request->unit_rates[$key],
            'cgst' => $request->cgst[$key],
            'sgst' => $request->sgst[$key],
            'igst' => $request->igst[$key],
            'amount' => $request->amounts[$key],
        ]);
    }
}

  toastr()->success('Invoice created successfully.', 'Success');
  return redirect('invoice/list');

}

public function update(Request $request, $id)
{
    $request->validate([
        'invoice_no' => 'required|string|max:255',
        'date' => 'required|date',
        'placeSupply' => 'required|string|max:255',
        'billName' => 'required|string',
        'billingAddress' => 'required|string',
        'billingPhoneNo' => 'required|string',
        'billingEmail' => 'required|string',
        'shipName' => 'required|string',
        'shipAddress' => 'required|string',
        'shipPhoneNo' => 'required|string',
        'shipEmail' => 'nullable|string',
        'emailAddress' => 'nullable|string',
        'items.*' => 'required|string|max:255',
        'description.*' => 'nullable|string|max:255',
        'quantities.*' => 'required|numeric|min:1',
        'unit_rates.*' => 'required|numeric|min:0',
        'cgst.*' => 'required|numeric|min:0',
        'sgst.*' => 'required|numeric|min:0',
        'igst.*' => 'required|numeric|min:0',
        'amounts.*' => 'required|numeric|min:0',
        'subTotal' => 'required|numeric|min:0',
        'discountInput' => 'required|numeric|min:0',
        'discountValue' => 'required|numeric|min:0',
        'netAmount' => 'required|numeric|min:0',
    ]);

    $invoice = Invoice::findOrFail($id);

    $invoice->update([
        'invoice_no' => $request->invoice_no,
        'date' => $request->date,
        'placeSupply' => $request->placeSupply,
        'billName' => $request->billName,
        'billingAddress' => $request->billingAddress,
        'billingPhoneNo' => $request->billingPhoneNo,
        'billingEmail' => $request->billingEmail,
        'shipName' => $request->shipName,
        'shipAddress' => $request->shipAddress,
        'shipPhoneNo' => $request->shipPhoneNo,
        'shipEmail' => $request->shipEmail,
        'subTotal' => $request->subTotal,
        'discountInput' => $request->discountInput,
        'discountValue' => $request->discountValue,
        'netAmount' => $request->netAmount,
    ]);

    // Delete existing items before re-adding updated items
    $invoice->items()->delete();


    foreach ($request->items as $key => $item) {

      $description = $request->description[$key] ?? 'No description'; // Default description if not provided or null
      // dd($description);
      if (!empty($description)) {
          $invoice->items()->create([
              'item' => $item,
              'description' => $description,
              'quantity' => $request->quantities[$key],
              'unit_rate' => $request->unit_rates[$key],
              'cgst' => $request->cgst[$key],
              'sgst' => $request->sgst[$key],
              'igst' => $request->igst[$key],
              'amount' => $request->amounts[$key],
          ]);
      }
  }

    toastr()->success('Invoice updated successfully.', 'Success');
    return redirect('invoice/list');
}


public function delete($id)
{
    $invoice = Invoice::findOrFail($id);

    $invoice->delete();

    toastr()->success('Invoice and associated items deleted successfully', 'Success');
    return redirect('invoice/list');
}


}