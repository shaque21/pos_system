@extends('layouts.admin')
@section('page_title','Restore Products')
@section('page-heading','Trash Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            All Trash Products Information
                        </h2>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <script>
                    swal({title: "Well Done !",text: "{{ Session::get('success') }}",
                        icon: "success",timer: 4000
                        });
                </script> 
            @endif
            @if (Session::has('error'))
                <script>
                    swal({title: "Opps !",text: "{{ Session::get('error') }}",
                        icon: "error",timer: 4000
                        });
                </script>
            @endif
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
                                <th>Description</th>
                                <th>Sell Price</th>
                                <th>Qty</th>
                                <th>Alert Stock</th>
                                <th class="text-center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key=>$product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ number_format($product->price,2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @if ($product->alert_stock >= $product->quantity)
                                            <span class="badge badge-danger">
                                                Low Stock ( {{ $product->quantity }} ) > {{ $product->alert_stock }}
                                            </span>
                                        @else
                                        <span class="badge badge-success">
                                            {{ $product->alert_stock }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="text-info mx-1" href="{{ url('/admin/restore/products/'.$product->product_slug) }}"><i class="fas fa-recycle fa-lg" data-toggle="tooltip" data-placement="top" title="Restore"></i></a>
                                        <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/restore/products/delete/'.$product->product_slug) }}"><i class="fas fa-trash fa-lg" data-toggle="tooltip" data-placement="top" title="Delete Task"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <span class="d-flex justify-content-center">{{ $products->links('pagination::bootstrap-4') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'Do you want to delete this record permanently!',
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