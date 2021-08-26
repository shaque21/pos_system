@extends('layouts.admin')
@section('page_title','View Sales Report')
@section('page-heading','Reports')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-uppercase font-weight-bold" style="font-size: 18px;letter-spacing:1px;">
                            All Order Details Of
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
    </script>
@endsection