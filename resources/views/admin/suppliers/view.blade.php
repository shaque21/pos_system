@extends('layouts.admin')
@section('page_title','View Suppliers Information')
@section('page-heading','Suppliers')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            View Suppliers Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/suppliers/edit/'.$suppliers->supplier_slug) }}" class="btn btn-dark font-weight-bold text-uppercase">
                            <i class="fas fa-wrench"></i>&nbsp 
                            Update Suppliers Information
                        </a>
                    </div>
                </div>
            </div>
            @if (Session::has('update_success'))
                <script>
                    swal({title: "Well Done!",text: "{{ Session::get('update_success') }}",
                        icon: "success",timer: 4000
                        });
                </script>
            @endif
            <div class="card-body">
                <div class="col-md-4 offset-4 mb-sm-5">
                    @if ($suppliers->supplier_img != '')
                        <img  src="{{asset('uploads/suppliers/'.$suppliers->supplier_img)}}" alt="Photo" >
                    @else
                        <img  src="{{ asset('uploads/suppliers/avarter.jpg') }}" alt="Photo" >
                    @endif
                </div>
                <div class="col-md-8 offset-2">
                    <table class="table table-bordered table-hover table-striped custom_view_table">
                        <tr>
                            <td>Supplier Name</td>
                            <td>:</td>
                            <td>{{ $suppliers->supplier_name }}</td>
                        </tr>
                        <tr>
                            <td>Brand Name</td>
                            <td>:</td>
                            <td>{{ $suppliers->supplier_brand }}</td>
                        </tr>
                        <tr>
                            <td>E-mail Address</td>
                            <td>:</td>
                            <td>{{ $suppliers->email }}</td>
                        </tr>
                        <tr>
                            <td>Mobile No.</td>
                            <td>:</td>
                            <td>{{ $suppliers->phone }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{ $suppliers->address }}</td>
                        </tr>
                        <tr>
                            <td>Create Time</td>
                            <td>:</td>
                            <td>{{ $suppliers->created_at->format('d M Y | h:i A') }}</td>
                        </tr>
                        @if (isset($suppliers->updated_at))
                            <tr>
                                <td>Updated Time</td>
                                <td>:</td>
                                <td>{{ $suppliers->updated_at->format('d M Y | h:i A') }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-primary btn-sm text-uppercase font-weight-bold">Print</a>
                <a href="#" class="btn btn-warning btn-sm text-uppercase font-weight-bold">PDF</a>
                <a href="#" class="btn btn-success btn-sm text-uppercase font-weight-bold">Excel</a>
            </div>
        </div>
    </div>
</div>
@endsection