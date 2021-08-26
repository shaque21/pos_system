<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class OrderDetailController extends Controller
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
        //
    }

    public function get_report(){
        return view('admin.reports.index');
    }

    public function todays_report(){
        $date = Carbon::now()->today();
        $date = $date->format('Y-m-d');
        return view('admin.dashboard.index',compact('date'));
    }

    public function check_report(Request $request){
        //Generate Day by day reports
        if($request->daily_date){
            $date = date('Y-m-d',strtotime($request->daily_date));
            $daily_report = OrderDetail::where('order_date',$date)->orderBy('id','DESC')->get();
            $total_sale = OrderDetail::where('order_date',$date)->sum('amount');
            return view('admin.reports.check',compact('daily_report','total_sale','date'));
        }

        // Generate Monthly Reports
        elseif($request->month && $request->year){
            // return $request->all();
            $month = $request->month;
            $year = $request->year;
            $daily_report = OrderDetail::whereMonth('order_date',$month)
                            ->whereYear('order_date',$year)->orderBy('id','DESC')->get();
            $total_sale = OrderDetail::whereMonth('order_date',$month)
                            ->whereYear('order_date',$year)->sum('amount');
            return view('admin.reports.check',compact('daily_report','total_sale','month','year'));
        }

        // Generate Yearly Reports
        else{
            $year = $request->year;
            $daily_report = OrderDetail::whereYear('order_date',$year)->orderBy('id','DESC')->get();
            $total_sale = OrderDetail::whereYear('order_date',$year)->sum('amount');
            return view('admin.reports.check',compact('daily_report','total_sale','year'));
        }
    }

    // Generate daily reports pdf
    public function daily_downloadPDF($date){
        $date = date('Y-m-d',strtotime($date));
        $daily_report = OrderDetail::where('order_date',$date)->orderBy('id','DESC')->get();
        $total_sale = OrderDetail::where('order_date',$date)->sum('amount');
        $pdf = PDF::loadView('admin.reports.pdf', compact('daily_report','total_sale','date'));
        return $pdf->download('day-reports.pdf');
    }
    // Generate Monthly reports pdf

    public function monthly_downloadPDF($month,$year){
        $month = $month;
        $year = $year;
        $daily_report = OrderDetail::whereMonth('order_date',$month)
                        ->whereYear('order_date',$year)->orderBy('id','DESC')->get();
        $total_sale = OrderDetail::whereMonth('order_date',$month)
                        ->whereYear('order_date',$year)->sum('amount');
        $pdf = PDF::loadView('admin.reports.pdf', compact('daily_report','total_sale','month','year'));
        return $pdf->download('monthly-reports.pdf');
    }
    // Generate yearly reports pdf

    public function yearly_downloadPDF($year){
        $year = $year;
        $daily_report = OrderDetail::whereYear('order_date',$year)->orderBy('id','DESC')->get();
        $total_sale = OrderDetail::whereYear('order_date',$year)->sum('amount');
        $pdf = PDF::loadView('admin.reports.pdf', compact('daily_report','total_sale','year'));
        return $pdf->download('yearly-reports.pdf');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
