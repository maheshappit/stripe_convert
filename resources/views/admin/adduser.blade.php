@extends('layouts.admindashboard')


@section('content')


<head>
   
<script>
        $(document).ready(function() {

            $('#myForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.user.create') }}',

                    data: formData,
                    success: function(response) {


                        if (response.status_code == 200) {
                            toastr.success(response.message);
                            $('#name').val('');
                            $('#email').val('');
                            $('#article').val('');
                            $('#email').val('');
                            $('#country').val('');

                            

                        }
                    },
                    error: function(xhr, status, error) {

                        var errors = xhr.responseJSON.errors;
                        console.log(errors)
                        handleValidationErrors(errors);
                    },
                });
            });

            function handleValidationErrors(errors) {
                // Display validation errors as toasts
                for (var field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        toastr.error(errors[field][0]);
                    }
                }
            }
        });
    </script>


</head>


<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;">
                            <i class="bi bi-grid-fill"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <!-- <div class="btn-group">
                                <button type="button" class="btn btn-primary">Settings</button>
                                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                    <a class="dropdown-item" href="javascript:;">Action</a>
                                    <a class="dropdown-item" href="javascript:;">Another action</a>
                                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:;">Separated link</a>
                                </div>
                            </div> -->
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Create New User</h5>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">
                        

                        <form id="myForm" class="row g-3">
                            @csrf
                           
                            <div class="col-12">
                                <label class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter  Name">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                           
                            <div class="col-12">
                                <button class="btn btn-primary px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</main>



@endsection