@extends('layouts.admin')
@section('page_title','Place Orders')
@section('page-heading','Cashier')
@section('content')
<div class="row">
    <div class="col-sm-9 col-md-8">
        <div class="card card-stats card-round">
            <div class="card-header bg-primary">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-white font-weight-bold">
                            Order Products
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-dark font-weight-bold text-uppercase">
                            <i class="fas fa-cart-plus"></i>&nbsp 
                            Add new product
                        </a>
                    </div>
                    @if (Session::has('success'))
                        <script>
                            swal({title: "Well Done !",text: "{{ Session::get('success') }}",
                                icon: "success",timer: 3000
                                });
                        </script> 
                    @endif
                    @if (Session::has('error'))
                        <script>
                            swal({title: "Opps !",text: "{{ Session::get('error') }}",
                                icon: "error",timer: 3000
                                });
                        </script>
                    @endif
                </div>
            </div>
            <form action="{{ url('/admin/orders/submit') }}" method="POST">
                @csrf
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 30%">Product Name<span class="order_req_star">*</span></th>
                                <th style="width: 15%">Qty<span class="order_req_star">*</span></th>
                                <th style="width: 15%">Price<span class="order_req_star">*</span></th>
                                <th style="width: 15%">Disc (%)</th>
                                <th style="width: 15%">Total<span class="order_req_star">*</span></th>
                                <th style="width: 5%" class="text-center">
                                    <a href="#" class="add_more">
                                        <i class="fas fa-plus-circle fa-lg text-success"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="add_new_product">
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="product_id[]" class="form-control product_id">
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach ($products as $product)
                                            <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="quantity[]" id="quantity"
                                    class="form-control quantity" >
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="price[]" id="price"
                                    class="form-control price" readonly>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="discount[]" id="discount"
                                    class="form-control discount" >
                                </td>
                                <td>
                                    <input type="number" name="total_amount[]" id="total_amount"
                                    class="form-control total_amount" readonly>
                                    @error('total_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-danger btn-xs">
                                        <i class="fas fa-times-circle fa-lg text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-header d-flex justify-content-center align-items-center bg-dark ">
                <h2 class="text-white text-uppercase" style="font-weight: 600;">
                    Total Amount : <b class="total">0</b>.00 <small>( BDT )</small>
                </h2>
            </div>
            <div class="card-body">
                <div class="btn-group btn-sm">
                    <a href="{{ url('/admin/cashier/receipt/download') }}" class="btn btn-secondary btn-sm text-uppercase font-weight-bold">
                        <i class="fas fa-file-pdf"></i>&nbsp; PDF
                    </a>
                    <button type="button" class="btn btn-dark btn-sm text-uppercase font-weight-bold" data-toggle="modal" data-target="#historyModal"
                    id="order_history"  >
                        <i class="fas fa-history"></i>&nbsp; HISTORY
                    </button>
                    <button type="button" class="btn btn-danger btn-sm text-uppercase font-weight-bold" data-toggle="modal" data-target="#dailyReportModal"
                    id="daily_report">
                    <i class="fas fa-chart-bar"></i>&nbsp; REPORT
                    </button>
                </div>
                <div class="col">
                    <table class="table table-striped">
                        <tr>
                            <td>
                                <label class="font-weight-bold" for="customer_name">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name"
                                class="form-control form-control-sm">
                            </td>
                            <td>
                                <label class="font-weight-bold" for="customer_mobile">Phone</label>
                                <input type="text" name="customer_mobile" id="customer_mobile"
                                class="form-control form-control-sm">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-sm">
                        <tr>
                            <td>
                                <p class="font-weight-bold">
                                    Payment Method
                                    <span class="order_req_star">*</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="payment_method" id="payment_method"
                                    class="true" value="cash" checked="checked" > &nbsp; &nbsp;
                                    <label for="payment_method">
                                        <i class="fas fa-money-bill-alt text-success"></i>&nbsp; Cash
                                    </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="payment_method" id="payment_method"
                                    class="true" value="bank transfer"> &nbsp; &nbsp;
                                    <label for="payment_method">
                                       <i class="fas fa-university text-danger"></i>&nbsp; Bank Transfer
                                    </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="payment_method" id="payment_method"
                                    class="true" value="credit card" > &nbsp; &nbsp;
                                    <label for="payment_method">
                                        <i class="fas fa-credit-card text-info"></i>&nbsp; Credit Card
                                    </label>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="col">
                    <label class="font-weight-bold" for="paid_amount">Pay Amount</label>
                    <span class="order_req_star">*</span>
                    <input type="number" name="paid_amount" id="paid_amount"
                    class="form-control form-control-sm">
                    @error('paid_amount')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                    <label class="font-weight-bold" for="change_balance">Returning Change</label>
                    <input type="number" readonly name="change_balance" id="change_balance"
                    class="form-control form-control-sm">
                </div>
            </div>
            <div class="card-footer">
                @php
                    use Carbon\Carbon;
                @endphp
                <div class="form-group">
                    <label class="font-weight-bold" for="order_date">Date :</label>
                    <input type="date" name="order_date" readonly class="form-control" value="{{ Carbon::now()->toDateString() }}">
                </div>
                <button class="btn btn-block btn-success" type="submit">Save</button>
            </div>
        </div>
    </form>
    </div>
</div>
<!-- Start The Modal For show history-->
<div class="modal fade" id="historyModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
      
        @php
            $last_order_id = App\Models\OrderDetail::max('order_id');
            $order_receipt = App\Models\OrderDetail::where('order_id',$last_order_id)->get();
        @endphp
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title text-uppercase font-weight-bold">
                Last Order History ( {{ $order_receipt['0']->created_at->format('Y M d | h:i A') }} )
            </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Available Qty</th>
                            <th>Alert Stock</th>
                            <th>Unit Price</th>
                            <th>Disc (%)</th>
                            <th>Method</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($order_receipt as $key=>$order)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $order->products->product_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->products->quantity }}</td>
                                <td>{{ $order->products->alert_stock }}</td>
                                <td>{{ number_format($order->unit_price,2) }}</td>
                                <td>{{ number_format($order->discount,2) }} %</td>
                                <td>{{ $order->transaction->payment_method }}</td>
                                <td>{{ number_format($order->amount,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>
<!-- End The Modal For show history-->
<!-- Start The Modal For daily report-->
<div class="modal fade" id="dailyReportModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title text-uppercase font-weight-bold">
                Today's Sales Report
            </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            @php
                // use Carbon\Carbon;
                $today = Carbon::now();
                $date = date('Y-m-d',strtotime($today));
                $todays_report = App\Models\OrderDetail::where('order_date',$date)
                ->orderBy('id','DESC')->get();
                $total_amount = App\Models\OrderDetail::where('order_date',$date)->sum('amount');
                
            @endphp
            <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered table-striped table-hover table-sm">
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
                        
                        @foreach ($todays_report as $key=>$order)
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
            
            <h2 class="text-danger">TOTAL AMOUNT : {{ '$ '. number_format($total_amount,2) }}</h2>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>
<!-- End The Modal For show daily report-->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#basic-datatables').DataTable({
			});
            // add new row
            $('.add_more').on('click',function(){
                var product = $('.product_id').html();
                var number_of_row = ($('.add_new_product tr').length - 0) + 1;
                var tr ='<tr><td class="no">' + number_of_row + '</td>' +
                        '<td><select name="product_id[]" class="form-control product_id">' +
                        product + 
                        '</select></td>' +
                        '<td><input type="number" name="quantity[]" id="quantity" class="form-control quantity" ></td>' +
                        '<td><input type="number" name="price[]" id="price" class="form-control price" readonly ></td>' +
                        '<td><input type="number" name="discount[]" id="discount" class="form-control discount" ></td>' +
                        '<td><input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount" readonly ></td>' +
                        '<td class="text-center"><a class="delete" href="#"><i class="fas fa-times-circle fa-lg text-danger"></i></a></td></tr>';

                $('.add_new_product').append(tr);
                         
            });
            // Remove row from table
            $('.add_new_product').delegate('.delete','click',function(){
                $(this).parent().parent().remove();
            });
            //Total Amount that display In the right head section
            function TotalAmount(){
                var total = 0;
                $('.total_amount').each(function(i,e){
                    var amount = $(this).val() - 0;
                    total += amount;
                });
                $('.total').html(total);
            }

            // when select a product then show the product price in the price field
            $('.add_new_product').delegate('.product_id','change',function(){
                var tr = $(this).parent().parent();
                var price = tr.find('.product_id option:selected').attr('data-price');
                tr.find('.price').val(price);
                var qty = tr.find('.quantity').val() - 0;
                var disc = tr.find('.discount').val() - 0;
                var price = tr.find('.price').val() - 0;
                var total_amount = (qty * price) - ((qty * price * disc) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            });

            // When keyup means put the quantity and discount(if any) then show the total 
            // amount in total field and also display in the right head section 
            $('.add_new_product').delegate('.quantity , .discount','keyup',function(){
                var tr = $(this).parent().parent();
                var qty = tr.find('.quantity').val() - 0;
                var disc = tr.find('.discount').val() - 0;
                var price = tr.find('.price').val() - 0;
                var total_amount = (qty * price) - ((qty * price * disc) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            });

            // When put the given amount then show change balance in the returning change field
            $('#paid_amount').keyup(function(){
                var total = $('.total').html();
                var paid_amount = $(this).val();
                var change_balance = paid_amount - total;
                $('#change_balance').val(change_balance);
            });

            $(document).on('click','#order_history',function(){
                var last_order_id = $(this).data('id');
                $.ajax({
                    url:'{{ url("/admin/orders/get-last-order-history") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{last_order_id:last_order_id},
                    success:function(data){

                        $('.modal-body').html(data)

                    }

                });
            });

        });
    </script>
@endsection