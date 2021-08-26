@extends('layouts.admin')
@section('page_title','All Transactions')
@section('page-heading','Transactions')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            All Transactions Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-end">
                        <a href="{{ url('/admin/transactions/download') }}" class="btn btn-danger btn-sm text-uppercase font-weight-bold">
                            <i class="fas fa-file-pdf text-white"></i>&nbsp;
                             Download PDF
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Paid Amount</th>
                                <th>Changes Amount</th>
                                <th>Date</th>
                                <th>Collected By</th>
                                <th>Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key=>$transaction)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $transaction->order->name }}</td>
                                    <td>{{ number_format($transaction->transaction_amount,2) }}</td>
                                    <td>{{ number_format($transaction->paid_amount,2) }}</td>
                                    <td>{{ number_format($transaction->change_balance,2) }}</td>
                                    <td>
                                        {{ $transaction->created_at->format('d M Y | h:i:s') }}
                                    </td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->payment_method }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <h2 class="text-success text-uppercase">
                    Total Transaction Amount : $ {{ number_format($transactions->sum('transaction_amount'),2) }}
                </h2>
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