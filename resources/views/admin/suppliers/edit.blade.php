@extends('layouts.admin')
@section('page_title','Edit Suppliers Profile')
@section('page-heading','Suppliers')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/suppliers/update')}}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold">
                                Update Supplier's Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/suppliers') }}" class="btn btn-dark font-weight-bold text-uppercase">
                                <i class="fas fa-globe"></i>&nbsp; 
                                All Suppliers Information 
                            </a>
                        </div>
                    </div>
                </div>
                @if (Session::has('update_error'))
                    <script>
                        swal({title: "Opps !",text: "{{ Session::get('update_error') }}",
                            icon: "error",timer: 4000
                            });
                    </script>
                @endif
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $suppliers->id }}">
                    <input type="hidden" name="product_slug" value="{{ $suppliers->supplier_slug }}">


                    <div class="form-group row">
                        <label for="supplier_name" class="col-sm-2 col-form-label custom_form_label">
                            Supplier Name:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control custom_form_control" name="supplier_name" value="{{ $suppliers->supplier_name }}">
                            @error('supplier_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supplier_brand" class="col-sm-2 col-form-label custom_form_label">
                            Brand:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control custom_form_control" name="supplier_brand" value="{{ $suppliers->supplier_brand }}">
                            @error('supplier_brand')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label custom_form_label">
                            Phone:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control custom_form_control" name="phone" value="{{ $suppliers->phone }}">
                            @error('phone')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label custom_form_label">
                            Email:<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control custom_form_control" name="email" value="{{ $suppliers->email }}">
                            @error('email')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label custom_form_label">
                            Address:
                        </label>
                        <div class="col-sm-10">
                          <textarea name="address" id="address" cols="10" rows="3" class="form-control custom_form_control">
                              {{ $suppliers->address }}
                          </textarea>
                         
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supplier_img" class="col-sm-2 col-form-label custom_form_label">
                            Supplier Photo:
                        </label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control custom_form_control" name="supplier_img" onchange="previewFile(this);" >
                            @if ($suppliers->supplier_img != '')
                                <img id="previewImg" width="150px" src="{{ asset('uploads/suppliers/'.$suppliers->supplier_img) }}" alt="Photo" >
                            @else
                                <img id="previewImg" width="150px" src="{{ asset('uploads/suppliers/avarter.jpg') }}" alt="Photo" >
                            @endif
                            @error('supplier_img')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-success font-weight-bold text-uppercase" type="submit">Update Supplier's Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection