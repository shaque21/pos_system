@extends('layouts.admin')
@section('page_title','Restore Users')
@section('page-heading','Trash Users')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h2 class="text-uppercase text-dark font-weight-bold">
                            All Trash Users Information
                        </h2>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="{{ url('/admin/users') }}" class="btn btn-dark font-weight-bold text-uppercase">
                            <i class="fas fa-globe"></i>&nbsp 
                            All Users
                        </a>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <script>
                    swal({title: "Well Done !",text: "{{ Session::get('success') }}",
                        icon: "success",timer: 4000
                        });
                </script> 
            @endif
            @if (Session::has('error'))
                <script>
                    swal({title: "Opps !",text: "{{ Session::get('error') }}",
                        icon: "error",timer: 4000
                        });
                </script>
            @endif
            @if (Session::has('delete_success'))
                <script>
                    swal({title: "Well Done !",text: "{{ Session::get('delete_success') }}",
                        icon: "success",timer: 4000
                        });
                </script> 
            @endif
            @if (Session::has('delete_error'))
                <script>
                    swal({title: "Opps !",text: "{{ Session::get('delete_error') }}",
                        icon: "error",timer: 4000
                        });
                </script>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Photo</th>
                                <th class="text-center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if ($item->user_role->role_name == 'Admin')
                                        <span class="badge badge-success">
                                            {{ $item->user_role->role_name }}
                                        </span>
                                        @else
                                        <span class="badge badge-secondary">
                                            {{ $item->user_role->role_name }}
                                        </span> 
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->photo != '')
                                            <img height="30px" src="{{ asset('uploads/users/'.$item->photo) }}" alt="Photo" >
                                        @else
                                            <img height="30px" src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" >
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="text-info mx-1" href="{{ url('/admin/restore/users/'.$item->slug) }}"><i class="fas fa-recycle fa-lg" data-toggle="tooltip" data-placement="top" title="Restore"></i></a>
                                        <a class="text-danger mx-1 delete-confirm" href="{{ url('/admin/restore/users/delete/'.$item->slug) }}"><i class="fas fa-trash fa-lg" data-toggle="tooltip" data-placement="top" title="Delete Task"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'Do you want to delete this record permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            })
            .then(function(value) {
                if (value) {
                    window.location.href = url;
                }
                else {
                    swal("Don't Worry! Your imaginary file is here.");
                }
            });
        });
        $('#basic-datatables').DataTable({
		});
    });
    
</script>
@endsection