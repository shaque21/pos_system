@extends('layouts.admin')
@section('page_title','Admin Dashboard')
@section('page-heading','Dashboard')
@section('content')
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    @php
                        $totalUsers = App\Models\User::where('status',1)->count();
                    @endphp
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Users</p>
                            <h4 class="card-title">
                                @if ($totalUsers<10)
                                    0{{ $totalUsers }}
                                @else
                                    {{ $totalUsers }}
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Products</p>
                            <h4 class="card-title">
                                @php
                                    $allProducts= App\Models\Product::where('product_status',1)
                                    ->count();
                                @endphp
                                @if ($allProducts < 10)
                                    0{{ $allProducts }}
                                @else
                                    {{ $allProducts }}
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="far fa-chart-bar"></i>
                        </div>
                    </div>
                    @php
                        $total_amount = App\Models\OrderDetail::sum('amount');
                    @endphp
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Sales</p>
                            <h4 class="card-title">$ {{ number_format($total_amount,2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                            <i class="far fa-check-circle"></i>
                        </div>
                    </div>
                    @php
                        $total_orders= App\Models\Order::count();
                    @endphp
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Order</p>
                            <h4 class="card-title">{{ $total_orders }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card-body">
            <h1 class="text-primary">{{ $chart1->options['chart_title'] }}</h1>
            {!! $chart1->renderHtml() !!}
            <hr />
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-body">
            <h1 class="text-primary">{{ $chart2->options['chart_title'] }}</h1>
            {!! $chart2->renderHtml() !!}
            <hr />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card-body">
            <h1 class="text-primary">{{ $chart3->options['chart_title'] }}</h1>
            {!! $chart3->renderHtml() !!}
        </div>
    </div>
</div>
{{-- Everyday Reports --}}
<div class="row">
    <div class="col-md-12">
        @php
            use Carbon\Carbon;
            $today = Carbon::now()->today();
            $date = $today->format('Y-m-d');
            $daily_report = App\Models\OrderDetail::where('order_date',$date)->orderBy('id','DESC')->get();
            $total_sale = App\Models\OrderDetail::where('order_date',$date)->sum('amount');
        @endphp
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-uppercase font-weight-bold" style="font-size: 18px;letter-spacing:1px;">
                            All Order Details Of ( Today ) : 
                           @php
                               if(isset($date)){
                                   echo $date;
                                   $url='/admin/reports/daily/download/'.$date;
                               }
                               else if(isset($month) && isset($year)){
                                   echo $month.'-'.$year;
                                   $url='/admin/reports/monthly/download/'.$month.'/'.$year;
                               }else{
                                   echo $year;
                                   $url='/admin/reports/yearly/download/'.$year;
                               }
                           @endphp 
                        </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ url($url) }}" class="btn btn-sm btn-danger text-uppercase mr-2">
                            <i class="fas fa-file-pdf"></i>&nbsp;
                             Download PDF
                        </a>
                        <a href="{{ url('/admin/reports') }}" class="btn btn-sm btn-dark text-uppercase">
                            <i class="fas fa-file-archive"></i>&nbsp;
                             Other Reports
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Available Qty</th>
                                <th>Unit Price</th>
                                <th>Disc (%)</th>
                                <th>Amount</th>
                                <th>Collected By</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Available Qty</th>
                                <th>Unit Price</th>
                                <th>Disc (%)</th>
                                <th>Amount</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($daily_report as $key=>$order)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $order->products->product_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->products->quantity }}</td>
                                <td>{{ number_format($order->unit_price,2) }}</td>
                                <td>{{ number_format($order->discount,2) }} %</td>
                                <td>{{ number_format($order->amount,2) }}</td>
                                <td>{{ $order->transaction->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <h1 class="text-dark">TOTAL AMOUNT : {{ '$ '. number_format($total_sale,2) }}</h1>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#basic-datatables').DataTable({
			});
        });
        {!! $chart1->renderChartJsLibrary() !!}

        {!! $chart1->renderJs() !!}
        {!! $chart2->renderJs() !!}
        {!! $chart3->renderJs() !!}
    </script>
@endsection