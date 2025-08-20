<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetails; 
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;  
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function FinalInvoice(Request $request){

    $rtotal = $request->total;
    $rpay = $request->pay;
    $mtotal = $rtotal - $rpay;   

    $data = [];
    $data['customer_id'] = $request->customer_id;
    $data['order_date'] = $request->order_date;
    $data['order_status'] = $request->order_status;
    $data['total_product'] = $request->total_product;
    $data['sub_total'] = $request->sub_total;
    $data['vat'] = $request->vat;
    $data['invoice_no'] = 'A2I' . mt_rand(100000000, 999999999);
    $data['total'] = $request->total;
    $data['payment_status'] = $request->payment_status;
    $data['pay'] = $request->pay;
    $data['due'] = $mtotal;
    $data['created_at'] = Carbon::now();

    // Insert order and get ID
    $order_id = Order::insertGetId($data);

    // Insert order details
    $contents = Cart::content();
    foreach ($contents as $content) {
        $pdata = [];
        $pdata['order_id'] = $order_id;
        $pdata['product_id'] = $content->id;
        $pdata['quantity'] = $content->qty;
        $pdata['unitcost'] = $content->price;
        $pdata['total'] = $content->price * $content->qty;
        $pdata['created_at'] = Carbon::now();

        Orderdetails::insert($pdata);
    }


    $notification = array(
        'message' => 'Order Complete Successfully',
        'alert-type' => 'success'
    );

    Cart::destroy();

    return redirect()->route('dashboard')->with($notification);

    } //End Mrthod

    public function PendingOrder(){

        $orders = Order::where('order_status','pending')->get();
        return view ('backend.order.pending_order',compact('orders'));

    } //End Mrthod

    public function OrderDetails($order_id){

        $order = Order::where('id',$order_id)->first();

        $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('backend.order.order_details',compact('order','orderItem'));

    } //End Mrthod


    public function OrderStatusUpdate(Request $request){

    $order_id = $request->id;

    $products = Orderdetails::where('order_id', $order_id)->get();

    foreach ($products as $item) {
        $product = Product::find($item->product_id);

        if ($product && $product->product_store >= $item->quantity) {
            // Reduce stock
            $product->update([
                'product_store' => DB::raw('product_store - ' . $item->quantity)
            ]);
        } else {
            // Not enough stock - stop and show error
            return redirect()->back()->with([
                'message' => 'Not enough stock for product: ' . ($product->product_name ?? 'Unknown'),
                'alert-type' => 'error'
            ]);
        }
    }

    Order::findOrFail($order_id)->update([
        'order_status' => 'complete'
    ]);

    return redirect()->route('pending.order')->with([
        'message' => 'Order Done Successfully',
        'alert-type' => 'success'
    ]);

    } //End Mrthod


    public function CompleteOrder(){

        $orders = Order::where('order_status','complete')->get();
        return view ('backend.order.complete_order',compact('orders'));

    } //End Mrthod

    public function StockMange(){

        $product = Product::latest()->get();
        return view('backend.stock.all_stock', compact('product'));

    } //End Mrthod

    public function OrderInvoice($order_id){
        
        $order = Order::where('id',$order_id)->first();

        $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        // Convert images to base64 for PDF
        foreach($orderItem as $item) {
            $imagePath = public_path($item->product->product_image);
            if(file_exists($imagePath)) {
                $imageData = base64_encode(file_get_contents($imagePath));
                $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                $item->product->product_image_base64 = 'data:image/' . $imageType . ';base64,' . $imageData;
            } else {
                $item->product->product_image_base64 = null;
            }
        }

        $pdf = Pdf::loadView('backend.order.order_invoice',compact('order','orderItem'))
                  ->setPaper('a4')
                  ->setOption([
                      'isHtml5ParserEnabled' => true,
                      'isPhpEnabled' => true,
                      'chroot' => public_path(),
                  ]);
        
        return $pdf->download('invoice.pdf');

    } //End Mrthod

    public function PendingDue(){

        $alldue = Order::where('due','>','0')->orderBy('id','DESC')->get();
        return view('backend.order.pending_due',compact('alldue'));

    } //End Mrthod

    public function OrderDueAjax($id){

        $order = Order::findOrfail($id);
        return response()->json($order);
    }

    public function UpdateDue(Request $request) {

    $order_id   = $request->id;
    $due_amount = $request->due;
    $pay_amount = $request->pay;

    $allorder = Order::findOrFail($order_id);

    $maindue = $allorder->due;
    $mainpay = $allorder->pay;

    // Update calculations
    $paid_due = $maindue - $due_amount;
    $paid_pay = $mainpay + $due_amount;

    // Save updated values
    $allorder->update([
        'due' => $paid_due,
        'pay' => $paid_pay,
    ]);

    $notification = [
        'message'    => 'Due Amount Updated Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('pending.due')->with($notification);
    }

}