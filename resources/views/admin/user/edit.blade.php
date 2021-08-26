@extends('layouts.admin')
@section('page_title','Edit Users')
@section('page-heading','Users')
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/users/update')}}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="text-uppercase text-dark font-weight-bold">
                                Update User's Information
                            </h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('/admin/users') }}" class="btn btn-dark font-weight-bold text-uppercase">
                                <i class="fas fa-users"></i>&nbsp; 
                                All Users Information 
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
                        <label for="name" class="col-sm-2 col-form-label custom_form_label">
                            Full Name :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control custom_form_control" name="name" value="{{ $users->name }}">
                            @error('name')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label custom_form_label">
                            E-mail Address :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control custom_form_control" name="email" value="{{ $users->email }}">
                            @error('email')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label custom_form_label">
                            Mobile :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control custom_form_control" name="mobile" value="{{ $users->mobile }}">
                          @error('mobile')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                    {{-- <div class="form-group row" style="display: none">
                        <label for="password" class="col-sm-2 col-form-label custom_form_label">
                            Password :<span class="req_star">*</span>
                        </label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control custom_form_control" name="password" value="{{ $users->password }}">
                          @error('password')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                    <div class="form-group row" style="display: none">
                        <label for="password_confirmation" class="col-sm-2 col-form-label custom_form_label">
                            Confirm-password :
                        </label>
                        <div class="col-sm-10">
                          <input type="password" id="password_confirmation" class="form-control custom_form_control" name="password_confirmation" value="{{ $users->password }}">
                          @error('password_confirmation')
                                <span class="alert alert-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="role_id" class="col-sm-2 col-form-label custom_form_label">
                            User Role :<span class="req_star">*</span> 
                        </label>
                        <div class="col-sm-10">
                            @php
                                $use_roles = App\Models\UserRole::where('role_status',1)->get();
                            @endphp
                            <select name="role_id" id="role_id" class="form-control custom_form_control">
                                <option value="" selected disabled>Select Role</option>
                                @foreach ($use_roles as $role)
                                <option  value="{{ $role->role_id }}" {{ ($users->role_id == $role->role_id) ? 'selected' : '' }}>
                                    {{ $role->role_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label custom_form_label">
                            Photo :
                        </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control custom_form_control"  name="photo" onchange="previewFile(this);">
                            <img id="previewImg" src="{{ asset('uploads/users/'.$users->photo) }}" alt="Photo" width="150px">
                            @error('photo')
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