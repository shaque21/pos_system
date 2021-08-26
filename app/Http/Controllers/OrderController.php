<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PDF;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('product_status',1)->orderBy('product_name','ASC')->get();
        $orders = Order::all();
        return view('admin.orders.index',compact('products','orders'));
    }
    // Last order details compact('products','order_receipt','orders')


    // public function get_last_order_details(){
    //     $products = Product::where('product_status',1)->get();
    //     $orders = Order::all();
    //     $last_order_id = OrderDetail::max('order_id');
    //     $order_receipt = OrderDetail::where('order_id',$last_order_id)->get();
    //     return view('admin.reports.receipt',compact('order_receipt','products','orders'));
    // }


    public function get_history(Request $request){
        $last_order_id = $request->last_order_id;
        $order_history = OrderDetail::where('order_id',$last_order_id)->get();
        return view('admin.orders.index',compact('order_history')); 
    }

    // Last order details compact('products','order_receipt','orders' and make a PDF file)
    public function downloadPDF(){
        $products = Product::where('product_status',1)->get();
        $orders = Order::all();
        $last_order_id = OrderDetail::max('order_id');
        $order_receipt = OrderDetail::where('order_id',$last_order_id)->get();
        $pdf = PDF::loadView('admin.reports.receipt', compact('products','order_receipt','orders'));
        return $pdf->download('invoice.pdf');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'product_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'total_amount'=>'required',
            'customer_mobile'=>'max:15',
            'payment_method'=>'required',
            'paid_amount'=>'required',
        ],[

        ]);

        // insert all requested data into orders table,order_details table and transactions table

        $insert = DB::transaction(function () use($request) {
            
            // Order Model(insert into orders table)
            $orders = new Order;
            $orders->name = $request->customer_name;
            $orders->mobile = $request->customer_mobile;
            $orders->save();
            $order_id = $orders->id;

            // OrderDetail Model(insert data into order_details table)

            for($product_id = 0; $product_id < count($request->product_id); $product_id++){
                $order_details = new OrderDetail;
                $order_details->order_id = $order_id;
                $order_details->product_id = $request->product_id[$product_id];
                $order_details->unit_price = $request->price[$product_id];
                $order_details->quantity = $request->quantity[$product_id];
                $order_details->discount = $request->discount[$product_id];
                $order_details->amount = $request->total_amount[$product_id];
                $order_details->save();
                DB::table('products')->where('id',$request->product_id[$product_id])
                ->decrement('quantity',$request->quantity[$product_id]);
            }

            // Transaction Model(insert data into transactions table)
            
            $transactions = new Transaction;
            $transactions->order_id = $order_id;
            $paid_amount = $transactions->paid_amount = $request->paid_amount;
            $change_balance = $transactions->change_balance = $request->change_balance;
            $transactions->transaction_amount = $paid_amount - $change_balance;
            $transactions->payment_method = $request->payment_method;
            $transactions->user_id = auth()->user()->id;
            $transactions->transaction_date = Carbon::now()->toDateTimeString();
            $transactions->save();


            // Last order history

            $products = Product::all();
            $order_details = OrderDetail::where('id',$order_id)->get();
            $orderedBy = Order::where('id',$order_id)->get();

            return view('admin.orders.index',[
                'products'=>$products,
                'order_details'=>$order_details,
                'customer_orders'=>$orderedBy
            ]);
            
        });
        if($insert){
            Session::flash('success','Your Order Inserted Successfully !');
            return redirect('/admin/orders');
        }
        else{
            Session::flash('error','Your Order Fails to Inserted !');
            return redirect('/admin/orders'); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
