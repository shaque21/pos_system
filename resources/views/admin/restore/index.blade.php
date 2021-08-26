@extends('layouts.admin')
@section('page_title','Restore')
@section('page-heading','Restore')
@section('content')
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    @php
                        $totalUsers = App\Models\User::where('status',0)->count();
                    @endphp
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <a href="{{ url('/admin/restore/users') }}" class="item_restore">
                                <p class="card-category">Users</p>
                            </a>
                            <h4 class="card-title">
                                @if ($totalUsers<10)
                                    0{{ $totalUsers }}
                                @elseif ($totalUsers == 0)
                                    00
                                @else
                                    {{ $totalUsers }}
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <a href="{{ url('/admin/restore/products') }}" class="item_restore">
                                <p class="card-category">Products</p>
                            </a>
                            <h4 class="card-title">
                                @php
                                    $allProducts= App\Models\Product::where('product_status',0)
                                    ->count();
                                @endphp
                                @if ($allProducts < 10)
                                    0{{ $allProducts }}
                                @elseif ($allProducts == 0)
                                    00
                                @else
                                    {{ $allProducts }}
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <a href="{{ url('/admin/restore/suppliers') }}" class="item_restore">
                                <p class="card-category">Suppliers</p>
                            </a>
                            <h4 class="card-title">
                                @php
                                    $suppliers= App\Models\Supplier::where('supplier_status',0)
                                    ->count();
                                @endphp
                                @if ($suppliers < 10)
                                0{{ $suppliers }}
                                @elseif ($suppliers == 0)
                                    00
                                @else
                                    {{ $suppliers }}
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection