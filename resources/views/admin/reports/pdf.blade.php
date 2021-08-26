<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<title>Print Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .tranc-table tr th{
            font-size: 10px;
        }
        .tranc-table tr td{
            font-size: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-md-6">
                            <p class="text-uppercase font-weight-bold" style="font-size: 18px;letter-spacing:1px;">
                                All Order Details Of
                               @php
                                   if(isset($date)){
                                       echo $date;
                                   }
                                   else if(isset($month) && isset($year)){
                                       echo $month.'-'.$year;
                                   }else{
                                       echo $year;
                                   }
                               @endphp 
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-sm tranc-table">
                        <table class="table table-bordered table-sm table-striped table-hover">
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
                    <div style="padding-top: 10px;">
                        <p class="text-uppercase font-weight-bold" style="font-size: 18px;letter-spacing:1px;">TOTAL AMOUNT : {{ '$ '. number_format($total_sale,2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>