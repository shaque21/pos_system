<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<title>Print Receipt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    {{-- <style>
        body {
        background: #eee
        }
        .address p{
            line-height: 3px;
        }
    </style> --}}
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-sm-11">
                <div class="p-3 bg-white rounded">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-uppercase text-danger">Roshan's Shop</h2>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Billed By:</span><span class="ml-1">{{ auth()->user()->name }}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span>
                                <span class="ml-1">
                                    {{ $order_receipt->first()->created_at->format('d M Y | h:i:s') }}
                                </span>
                            </div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Order ID:</span>
                                <span class="ml-1">#{{ $order_receipt->first()->order_id }}</span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class="mt-sm-3 text-purple">Contact Us</h5>
                            <table class="table table-borderless table-sm" style="font-size: 14px;">
                                <tr>
                                    <td>Address : 20/1, Mitford, Dhaka-1201</td>
                                </tr>
                                <tr>
                                    <td>E-mail Address : roshans.shop@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>Phone : +880 1627-309821</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_receipt as $receipt)
                                    <tr>
                                        <td>
                                            @foreach ($products as $product)
                                               @if ($product->id === $receipt->product_id)
                                                   {{ $product->product_name }}
                                               @endif 
                                            @endforeach
                                        </td>
                                        <td>{{ $receipt->quantity }}</td>
                                        <td>{{ number_format($receipt->unit_price,2) }}</td>
                                        <td>{{ ($receipt->discount == '') ? '0.00 %' : $receipt->discount.'.00 %' }}</td>
                                        <td>{{ number_format($receipt->amount,2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="font-weight-bold">Sub Total</td>
                                        <td>{{ number_format($order_receipt->sum('amount'),2) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="font-weight-bold">Tax (0.00%)</td>
                                        <td>
                                            @php
                                                $sub_total = $order_receipt->sum('amount');
                                                $vat = ($sub_total * 0) / 100;
                                                echo number_format($vat,2);
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="font-weight-bold">Total</td>
                                        <td>
                                            {{-- {{ number_format($order_receipt->sum('amount'),2) }} --}}
                                            @php
                                                $sub_total = $order_receipt->sum('amount');
                                                $vat = ($sub_total * 0) / 100;
                                                $total = $sub_total + $vat;
                                                echo number_format($total,2);
                                            @endphp
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <p style="font-weight: 600;">** Thanks For Visiting Our Shop **</p>
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