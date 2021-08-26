@extends('layouts.admin')
@section('page_title','Update Password')
@section('page-heading','Update Password')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/profile/password_update')}}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold">
                                Update My Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/profile/user_profile/'.$users->slug) }}" class="btn btn-dark font-weight-bold text-uppercase">
                                <i class="fas fa-user-alt"></i>&nbsp; 
                                My Profile 
                            </a>
                        </div>
                    </div>
                </div>
                
                @if (Session::has('update_error'))
                    <script>
                        swal({title: "Opps!",text: "Income Category is not Updated!",
                            icon: "error",timer: 4000
                            });
                    </script>
                @endif
                <div class="card-body">
                    <input type="hidden" name="id" id="id" value="{{ $users->id }}">
                    <input type="hidden" name="slug" id="slug" value="{{ $users->slug }}">
                    
                    <div class="form-group row">
                        <label for="c_password" class="col-sm-2 col-form-label custom_form_label">
                            Current Password :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control custom_form_control" name="c_password" placeholder="Old Password">
                          @error('c_password')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label custom_form_label">
                            New Password :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control custom_form_control" name="password" placeholder="New Password">
                          @error('password')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-2 col-form-label custom_form_label">
                            Confirm-password :
                        </label>
                        <div class="col-sm-10">
                          <input type="password" id="password_confirmation" class="form-control custom_form_control" name="password_confirmation" placeholder="Confirm-Password">
                          @error('password_confirmation')
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