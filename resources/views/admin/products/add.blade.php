@extends('layouts.admin')
@section('page_title','Add New Product')
@section('page-heading','Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/products/submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                @if (Session::has('success'))
                    <script>
                        swal({title: "Good job!",text: "{{ Session::get('success') }}",
                            icon: "success",timer: 4000
                            });
                    </script>
                @endif
                @if (Session::has('error'))
                    <script>
                        swal({title: "Opps!",text: "{{ Session::get('success') }}",
                            icon: "error",timer: 4000
                            });
                    </script>
                @endif
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold">
                                Add Product Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/products') }}" class="btn btn-dark font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Available Products 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="product_name" class="col-sm-2 col-form-label custom_form_label">
                            Product Name:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control custom_form_control" name="product_name" value="{{ old('product_name') }}">
                            @error('product_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label custom_form_label">
                            Brand:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control custom_form_control" name="brand" value="{{ old('brand') }}">
                            @error('brand')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label custom_form_label">
                            Price:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control custom_form_control" name="price" value="{{ old('price') }}">
                            @error('price')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-2 col-form-label custom_form_label">
                            Quantity:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control custom_form_control" name="quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alert_stock" class="col-sm-2 col-form-label custom_form_label">
                            Alert Stock:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control custom_form_control" name="alert_stock" value="{{ old('alert_stock') }}">
                            @error('alert_stock')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label custom_form_label">
                            Description:
                        </label>
                        <div class="col-sm-10">
                          <textarea name="description" id="" cols="10" rows="3" class="form-control custom_form_control"></textarea>
                          @error('description')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product_img" class="col-sm-2 col-form-label custom_form_label">
                            Product Image:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control custom_form_control" name="product_img" value="{{ old('product_img') }}">
                          @error('product_img')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-success font-weight-bold text-uppercase" type="submit">submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection