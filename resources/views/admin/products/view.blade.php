@extends('layouts.admin')
@section('page_title','View Products Information')
@section('page-heading','Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            View Products Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/products/edit/'.$data['0']->product_slug) }}" class="btn btn-dark font-weight-bold text-uppercase">
                            <i class="fas fa-wrench"></i>&nbsp 
                            Update Products Information
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
                    <img src="{{asset('storage/productImages/'.$data['0']->product_img)}}" alt="..." class="container-fluid avatar-img rounded profile_img">
                </div>
                <div class="col-md-8 offset-2">
                    <table class="table table-bordered table-hover table-striped custom_view_table">
                        <tr>
                            <td>Product Name</td>
                            <td>:</td>
                            <td>{{ $data['0']->product_name }}</td>
                        </tr>
                        <tr>
                            <td>Brand Name</td>
                            <td>:</td>
                            <td>{{ $data['0']->brand }}</td>
                        </tr>
                        <tr>
                            <td>Sell Price</td>
                            <td>:</td>
                            <td>{{ number_format($data['0']->price,2) }}</td>
                        </tr>
                        <tr>
                            <td>Product Code</td>
                            <td>:</td>
                            <td>{{ $data['0']->product_code }}</td>
                        </tr>
                        <tr>
                            <td>Product's Barcode</td>
                            <td>:</td>
                            <td>
                                <img src="{{ asset('contents/admin/products/barcode/'.$data['0']->barcode) }}"
                                 alt="" width="150px" height="50px">
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>:</td>
                            <td>{{ $data['0']->quantity }}</td>
                        </tr>
                        <tr>
                            <td>Alert Stocks</td>
                            <td>:</td>
                            <td>
                                @if ($data['0']->alert_stock >= $data['0']->quantity)
                                    <span class="badge badge-danger">
                                        Low Stock ( {{ $data['0']->quantity }} )  >  {{ $data['0']->alert_stock }}
                                    </span>
                                @else
                                    <span class="badge badge-success">
                                        {{ $data['0']->alert_stock }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td>{{ $data['0']->description }}</td>
                        </tr>
                        <tr>
                            <td>Create Time</td>
                            <td>:</td>
                            <td>{{ $data['0']->created_at->format('d M Y | h:i A') }}</td>
                        </tr>
                        @if (isset($data['0']->updated_at))
                            <tr>
                                <td>Updated Time</td>
                                <td>:</td>
                                <td>{{ $data['0']->updated_at->format('d M Y | h:i A') }}</td>
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