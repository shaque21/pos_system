@extends('layouts.admin')
@section('page_title','Products Barcode')
@section('page-heading','Barcode')
@section('content')
<div class="row">
    @foreach ($products as $product)
    <div class="col-sm-6 col-md-6">
        <div class="card card-stats card-round">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h2 class="text-primary">{{ $product->product_name }}</h2>
            </div>
            <div class="card-body ">
                <div class="row d-flex justify-content-center align-items-center p-4">
                    <img src="{{ asset('contents/admin/products/barcode/'.$product->barcode) }}"
                    alt="Product barcode" width="80%" height="50%">
                    
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center align-items-center">
                <p class="font-weight-bold">{{ $product->product_code }}</p>
            </div>
        </div>
    </div>
    @endforeach
    
@endsection