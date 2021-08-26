
@if (!isset(Auth::user()->id))
	return redirect('/login')
@endif

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<title>@yield('page_title','Admin Dashboard')</title>
    <link rel="icon" href="{{asset('contents/admin')}}/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{asset('contents/admin')}}/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{asset('contents/admin')}}/assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<link rel="stylesheet" href="{{ asset('contents/admin') }}/assets/css/cropper.min.css">

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/azzara.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/demo.css">
	<link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/style.css">
	<script src="{{asset('contents/admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="{{asset('contents/admin')}}/assets/js/sweetalert.min.js"></script>
</head>
<body>
	<div class="wrapper">
		<!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="purple">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="{{ url('/admin/dashboard') }}" class="logo d-flex justify-content-center align-items-center">
					<h2 class="text-uppercase text-white" style="letter-spacing: 1px">
						Roshan<span class="text-warning font-weight-bold">'</span>s Shop
					</h2>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">
				
				<div class="container-fluid">
					{{-- <div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div> --}}
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						{{-- <li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li> --}}


						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									@php
										$uid = Auth()->user()->id;
										$data = App\Models\User::where('status',1)->where('id',$uid)->firstOrFail();
									@endphp
									@if ($data->photo != '')
										<img src="{{ asset('uploads/users/'.$data->photo) }}" alt="Photo" class="avatar-img rounded-circle">
									@else
										<img src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" class="avatar-img rounded-circle">
									@endif
									{{-- <img src="{{asset('contents/admin')}}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle"> --}}
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg">
											@if ($data->photo != '')
												<img src="{{ asset('uploads/users/'.$data->photo) }}" alt="Photo" class="avatar-img rounded">
											@else
												<img src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" class="avatar-img rounded">
											@endif
											{{-- <img src="{{asset('contents/admin')}}/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"> --}}
										</div>
										<div class="u-text">
											<h4>{{ Auth::user()->name }}</h4>
											<p class="text-muted">{{ Auth::user()->email }}</p><a href="{{ url('/admin/profile/user_profile/'.Auth::user()->slug) }}" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ url('/admin/profile/user_profile/'.Auth::user()->slug) }}">
										<i class="fas fa-user-alt"></i> &nbsp
										My Profile
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item text-danger" href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
										<i class="fas fa-power-off"></i> &nbsp
										Logout
									</a>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							{{-- @php
								$uid = Auth()->user()->id;
								$data = App\Models\User::where('status',1)->where('id',$uid)->firstOrFail();
							@endphp --}}
							@if ($data->photo != '')
								<img src="{{ asset('uploads/users/'.$data->photo) }}" alt="Photo" class="avatar-img rounded-circle">
							@else
								<img src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" class="avatar-img rounded-circle">
							@endif
							{{-- <img src="{{asset('contents/admin')}}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle"> --}}
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->name }}
									<span class="user-level">
										@if ($data->user_role->role_name == 'Admin')
                                        <span class="badge badge-success">
                                            {{ $data->user_role->role_name }}
                                        </span>
                                        @else
                                        <span class="badge badge-secondary">
                                            {{ $data->user_role->role_name }}
                                        </span> 
                                        @endif
									</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav">
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">NAVBAR</h4>
						</li>
						@if (Auth::user()->role_id == 1)
						<li class="nav-item {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }} ">
							<a href="{{ url('/admin/dashboard') }}">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'profile') ? 'active' : '' }}">
							<a href="{{ url('/admin/profile/user_profile/'.Auth::user()->slug) }}">
								<i class="fas fa-user-alt"></i>
								<p>Profile</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'users') ? 'active' : '' }}">
							<a href="{{ url('/admin/users') }}">
								<i class="fas fa-users"></i>
								<p>Users</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'products') ? 'active' : '' }}">
							<a href="{{ url('/admin/products') }}">
								<i class="fas fa-gift"></i>
								<p>Products</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'orders') ? 'active' : '' }}">
							<a href="{{ url('/admin/orders') }}">
								<i class="fas fa-laptop"></i>
								<p>Cashier</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'reports') ? 'active' : '' }}">
							<a href="{{ url('/admin/reports') }}">
								<i class="fas fa-file"></i>
								<p>Reports</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'transactions') ? 'active' : '' }}">
							<a href="{{ url('/admin/transactions') }}">
								<i class="fas fa-money-bill-alt"></i>
								<p>Transactions</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'suppliers') ? 'active' : '' }}">
							<a href="{{ url('/admin/suppliers') }}">
								<i class="fas fa-shipping-fast"></i>
								<p>Suppliers</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'barcode') ? 'active' : '' }}">
							<a href="{{ url('/admin/barcode') }}">
								<i class="fas fa-barcode"></i>
								<p>Products Barcode</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'restore') ? 'active' : '' }}">
							<a href="{{ url('/admin/restore') }}">
								<i class="fas fa-recycle"></i>
								<p>Restore</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
								<i class="fas fa-power-off"></i>
								<p class="text-danger">Logout</p>
							</a>
						</li>
						@else
						<li class="nav-item {{ (request()->segment(2) == 'orders') ? 'active' : '' }}">
							<a href="{{ url('/admin/orders') }}">
								<i class="fas fa-laptop"></i>
								<p>Cashier</p>
							</a>
						</li>
						<li class="nav-item {{ (request()->segment(2) == 'profile') ? 'active' : '' }}">
							<a href="{{ url('/admin/profile/user_profile/'.Auth::user()->slug) }}">
								<i class="fas fa-user-alt"></i>
								<p>Profile</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
								<i class="fas fa-power-off"></i>
								<p class="text-danger">Logout</p>
							</a>
						</li>
						@endif

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">
							@yield('page-heading')
						</h4>
					</div>
                    {{-- add dashboard/index.blade.php file here --}}
					@yield('content')
				</div>
			</div>
			
		</div>
		
	</div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
<!--   Core JS Files   -->
<script src="{{asset('contents/admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/core/popper.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Moment JS -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/moment/moment.min.js"></script>

<!-- Chart JS -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/gmaps/gmaps.js"></script>

{{-- cropper js for image upload --}}
<script src="{{asset('contents/admin')}}/assets/js/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src="{{asset('contents/admin')}}/assets/js/cropper.min.js"></script>
<!-- Sweet Alert -->
<script src="{{asset('contents/admin')}}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="{{asset('contents/admin')}}/assets/js/ready.min.js"></script>

@yield('script')
</body>
</html>