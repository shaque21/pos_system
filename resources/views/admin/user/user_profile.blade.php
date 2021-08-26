@extends('layouts.admin')
@section('page_title','User Profile')
@section('page-heading','My Profile')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            My Informations
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/profile/edit_user_password/'.$data->slug) }}" class="btn btn-secondary btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-key"></i>&nbsp 
                            Update Password
                        </a>
                        <a href="{{ url('/admin/profile/edit_user_profile/'.$data->slug) }}" class="ml-2 btn btn-dark btn-sm font-weight-bold text-uppercase">
                            <i class="fas fa-user-edit"></i>&nbsp 
                            Update My Account
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
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-profile card-secondary">
                        <div class="card-header" style="background-image: url('{{ asset('contents/admin/assets/img/blogpost.jpg') }}')">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    @if(Auth::user()->photo!='')
                                        <img src="{{asset('uploads/users/'.Auth::user()->photo)}}" alt="photo" class="avatar-img rounded-circle"/>
                                    @else
                                        <img src="{{asset('uploads/avatar.jpg')}}" alt="photo" class="avatar-img rounded-circle"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">{{ Auth::user()->name }}</div>
                                <div class="job"><span class="badge badge-secondary">{{ Auth::user()->user_role->role_name }}</span></div>
                                <div class="desc">A man who hates loneliness</div>
                                <div class="social-media">
                                    <a class="btn btn-info btn-twitter btn-sm btn-link" href="#"> 
                                        <span class="btn-label just-icon"><i class="fab fa-twitter"></i> </span>
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                                        <span class="btn-label just-icon"><i class="fab fa-google-plus"></i> </span> 
                                    </a>
                                    <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#"> 
                                        <span class="btn-label just-icon"><i class="fab fa-facebook-f"></i> </span> 
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                                        <span class="btn-label just-icon"><i class="fab fa-dribbble"></i> </span> 
                                    </a>
                                </div>
                                <div class="view-profile">
                                    <a href="{{ url('/admin/profile/edit_user_profile/'.$data->slug) }}" class="btn btn-secondary btn-block">Update My Account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile</a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Name</label>
                                        <input readonly style="font-weight: 600;color:rebeccapurple!important; padding:8px" type="text" class="form-control" name="name" placeholder="Name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Email</label>
                                        <input readonly style="font-weight: 600;color:rebeccapurple!important; padding:8px" type="email" class="form-control" name="email" placeholder="Name" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Phone</label>
                                        <input readonly style="font-weight: 600;color:rebeccapurple!important; padding:8px" type="text" class="form-control" value="{{ Auth::user()->mobile }}" name="mobile" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Account Create Time</label>
                                        <input readonly style="font-weight: 600;color:rebeccapurple!important; padding:8px" type="text" class="form-control" value="{{ Auth::user()->created_at->format('Y M d | h:i:s A') }}" name="created_at" placeholder="Create Time">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection