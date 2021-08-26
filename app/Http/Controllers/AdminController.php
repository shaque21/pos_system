<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\User;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
    
        $chart1 = new LaravelChart($chart_options);
    
    
        $chart_options = [
            'chart_title' => 'Users by names',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'group_by_field' => 'name',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show users only registered this month
        ];
    
        $chart2 = new LaravelChart($chart_options);
    
        $chart_options = [
            'chart_title' => 'Transactions by day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Transaction',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'transaction_amount',
            'chart_type' => 'line',
        ];
    
        $chart3 = new LaravelChart($chart_options);
        return view('admin.dashboard.index',compact('chart1', 'chart2', 'chart3'));
    }
}
