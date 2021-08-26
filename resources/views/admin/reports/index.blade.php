@extends('layouts.admin')
@section('page_title','View Sales Report')
@section('page-heading','Reports')
@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-header text-center">
                <p class="text-uppercase font-weight-bold" style="font-size: 18px;letter-spacing:1px;">
                    Daily Reports
                </p>
            </div>
            
            <div class="card-body">
                <form action="{{ url('/admin/reports/check') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="daily_date" style="font-size: 14px!important;font-weight:600;">Date :</label>
                        <input type="date" class="form-control" name="daily_date" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-header text-center">
                <p class="text-uppercase font-weight-bold" style="font-size: 18px;letter-spacing:1px;">
                    Monthly Reports
                </p>
            </div>
            
            <div class="card-body">
                <form action="{{ url('/admin/reports/check') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="month" id="month" class="form-control" required>
                            <option value="" selected disabled>Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="year" id="year" class="form-control" required>
                            <option value="" selected disabled>Select Year</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-header text-center">
                <p class="text-uppercase font-weight-bold" style="font-size: 18px;letter-spacing:1px;">
                    Yearly Reports
                </p>
            </div>
            
            <div class="card-body">
                <form action="{{ url('/admin/reports/check') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="year" id="year" class="form-control" required>
                            <option value="" selected disabled>Select Year</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-dark btn-sm" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection