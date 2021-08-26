@extends('layouts.admin')
@section('page_title','All Products')
@section('page-heading','Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            All Products Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-dark font-weight-bold text-uppercase">
                            <i class="fas fa-cart-plus"></i>&nbsp 
                            Add new product
                        </a>
                    </div>
                </div>
            </div>
            @if (Session::has('delete_success'))
                <script>
                    swal({title: "Well Done !",text: "{{ Session::get('delete_success') }}",
                        icon: "success",timer: 4000
                        });
                </script> 
            @endif
            @if (Session::has('delete_error'))
                <script>
                    swal({title: "Opps !",text: "{{ Session::get('delete_error') }}",
                        icon: "error",timer: 4000
                        });
                </script>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Brand Name</th>
                                <th>Product's Code</th>
                                <th>Sell Price</th>
                                <th>Qty</th>
                                <th>Alert Stock</th>
                                <th class="text-center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allProducts as $key=>$product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->product_code }}</td>
                                    <td>{{ number_format($product->price,2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @if ($product->alert_stock >= $product->quantity)
                                            <span class="badge badge-danger">
                                                Low Stock ( {{ $product->quantity }} ) > {{ $product->alert_stock }}
                                            </span>
                                        @else
                                        <span class="badge badge-success">
                                            @if ($product->alert_stock < 10)
                                            0{{ $product->alert_stock }}
                                            @else
                                            {{ $product->alert_stock }}
                                            @endif
                                            
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="text-dark mx-1" href="{{ url('/admin/products/view/'.$product->product_slug) }}" data-toggle="tooltip" data-placement="top" title="View Task"><i class="fas fa-eye fa-lg"></i></a>
                                        <a class="text-info mx-1" href="{{ url('/admin/products/edit/'.$product->product_slug) }}"><i class="fas fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Edit Task"></i></a>
                                        <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/products/soft-delete/'.$product->product_slug) }}"><i class="fas fa-trash fa-lg" data-toggle="tooltip" data-placement="top" title="Remove Task"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record moves to Restore and would be inactivated.',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            })
            .then(function(value) {
                if (value) {
                    window.location.href = url;
                }
                else {
                    swal("Don't Worry! Your imaginary file is here.");
                }
            });
        });
        $('#basic-datatables').DataTable({
		});
    });
    
</script>
@endsection