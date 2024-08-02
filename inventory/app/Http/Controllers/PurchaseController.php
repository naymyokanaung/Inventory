<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\PurchaseDetails;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetails;
use Illuminate\Http\Request;
use PDF;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::all();
        $purchasedetails = PurchaseDetails::all();
        $products = Product::all();
        return view('purchase.index', ['purchaseOrders'=>$purchaseOrders, 'purchaseDetails'=>$purchasedetails, 'products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proivders = Provider::all();
        $products = Product::all();
        return view('purchase.create', ['providers'=>$proivders , 'products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'provider_id' => 'required|exists:providers,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ], [
            'provider_id.required' => "Please select a provider.",
            'provider_id.exists' => "The selected provider does not exist.",
            'product_id.required' => "Please select a product.",
            'product_id.exists' => "The selected product does not exist.",
            'qty.required' => "Please enter the quantity.",
            'qty.integer' => "Quantity must be a valid number.",
            'qty.min' => "Quantity must be at least 1.",
            'price.required' => "Please enter the price.",
            'price.numeric' => "Price must be a valid number.",
            'price.min' => "Price must be at least 0.",
            'total_order.numeric' => "Total order must be a valid number.",
            'total_order.min' => "Total order must be at least 0.",
        ]);
    
        $purchaseOrderDetails = PurchaseDetails::create([
            'provider_id' => $request->provider_id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'price' => $request->price,
            'total_order' => $request->qty * $request->price,
        ]);

        $order_no = 'ORDN-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        PurchaseOrder::create([
            'order_no' => $order_no,
            'order_id' => $purchaseOrderDetails->id,
            'purchaseorder_date' => now(), // Set current date
        ]);

        return redirect()->route('purchase.index')->with('createsuccess', 'Purchase created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseorder = PurchaseOrder::find($id);
        $providers = Provider::all();
        $purchasedetails = PurchaseDetails::all();
        $products = Product::all();
        $id = $purchaseorder->order_id;
        return view('purchase.view', ['providers'=>$providers, 'purchaseDetails'=>$purchasedetails,
                     'products'=>$products, 'purchaseOrder'=>$purchaseorder,'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseorder = PurchaseOrder::find($id);
        $providers = Provider::all();
        $purchasedetails = PurchaseDetails::all();
        $products = Product::all();
        return view('purchase.edit', ['providers'=>$providers, 'purchaseDetails'=>$purchasedetails, 'products'=>$products, 'purchaseOrder'=>$purchaseorder]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $purchaseDetail = PurchaseDetails::find($id);
        $request->validate([
            'provider_id' => 'required|exists:providers,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1 ',
            'price' => 'required|numeric|min:0',
        ], [
            'provider_id.required' => "Please select a provider.",
            'provider_id.exists' => "The selected provider does not exist.",
            'product_id.required' => "Please select a product.",
            'product_id.exists' => "The selected product does not exist.",
            'qty.required' => "Please enter the quantity.",
            'qty.integer' => "Quantity must be a valid number.",
            'qty.min' => "Quantity must be at least 1.",
            'price.required' => "Please enter the price.",
            'price.numeric' => "Price must be a valid number.",
            'price.min' => "Price must be at least 0.",
            'total_order.numeric' => "Total order must be a valid number.",
            'total_order.min' => "Total order must be at least 0.",
        ]);
            
        $purchaseDetail->update([
            'provider_id' => $request->provider_id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'price' => $request->price,
            'total_order' => $request->qty * $request->price,
        ]);

        return redirect()->route('purchase.index')->with('editsuccess', 'Purchase updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PurchaseDetails::destroy($id);
        return redirect()->route('purchase.index')->with('deletesuccess', 'Purchase deleted successfully.');
    }
    public function download($id){
        $purchaseorder = PurchaseOrder::find($id);
        if (!$purchaseorder) {
                    abort(404, 'Purchase order not found');
        }
        
        $providers = Provider::all();
        $purchasedetails = PurchaseDetails::all();
        $products = Product::all();
        $id = $purchaseorder->order_code;

        $pdf = PDF::loadView('purchase.download',['providers'=>$providers, 'purchaseDetails'=>$purchasedetails,
         'products'=>$products, 'purchaseOrder'=>$purchaseorder,'id'=>$id]);
         return $pdf->download('invoice-' . $id . '.pdf');
    }
}
