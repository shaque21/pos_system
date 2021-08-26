@extends('layouts.admin')
@section('page_title','All Suppliers')
@section('page-heading','Suppliers')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            All Suppliers Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/suppliers/create') }}" class="btn btn-dark font-weight-bold text-uppercase">
                            <i class="fas fa-user-plus"></i> &nbsp 
                            Add new Supplier
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
                                <th>Supplier Name</th>
                                <th>Brand</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th class="text-center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $key=>$supplier)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td>{{ $supplier->supplier_brand }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>
                                        @if ($supplier->supplier_img != '')
                                            <img height="30px" src="{{ asset('uploads/suppliers/'.$supplier->supplier_img) }}" alt="Photo" >
                                        @else
                                            <img height="30px" src="{{ asset('uploads/suppliers/avarter.jpg') }}" alt="Photo" >
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="text-dark mx-1" href="{{ url('/admin/suppliers/view/'.$supplier->supplier_slug) }}" data-toggle="tooltip" data-placement="top" title="View Task"><i class="fas fa-eye fa-lg"></i></a>
                                        <a class="text-info mx-1" href="{{ url('/admin/suppliers/edit/'.$supplier->supplier_slug) }}"><i class="fas fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Edit Task"></i></a>
                                        <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/suppliers/soft-delete/'.$supplier->supplier_slug) }}"><i class="fas fa-trash fa-lg" data-toggle="tooltip" data-placement="top" title="Remove Task"></i></a>
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
                text: 'Do you want to delete this record !',
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