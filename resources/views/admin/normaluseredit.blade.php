@extends('layouts.admindashboard')


@section('content')


<head>

    <script>
        $(document).ready(function() {

            $('#myForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var updateId = document.getElementById('userid').value;


                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.normaluser.update', ['id' => '']) }}' + updateId,

                    data: formData,
                    success: function(response) {

                        console.log(formData);

                        if (response.status_code == '200') {
                            toastr.success(response.message);
                            setTimeout(function() {
                                 window.location.href = '{{ route('admin.show.allusers') }}'; 
                         }, 2000);  


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


    <script>
        $(document).ready(function() {
            // Attach an event listener to the select element
            $('#client_status_select').change(function() {
                // Get the selected value
                var selectedValue = $(this).val();

                // Check if the selected value is 'Followup'
                if (selectedValue == '3') {
                    // Show the container with additional fields
                    $('#followup_fields').show();
                } else {
                    // Hide the container if the selected value is not 'Followup'
                    $('#followup_fields').hide();
                }
            });
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
                    <li class="breadcrumb-item active" aria-current="page">Update User</li>
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
                    <h5 class="mb-0">Update User</h5>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">


                        <form id="myForm" class="row g-3">
                        @csrf

                        <input type="text"  hidden value="{{$user->id}}" id="userid"  >

                          
                           
                            <div class="col-12">
                                <label class="form-label">Client Name:</label>
                                <input type="text" class="form-control" value="{{$user->name ?? ''}}"  name="name" placeholder="Enter Client Name">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control"  value="{{$user->email ?? ''}}" name="email" placeholder="Enter Email">
                            </div>

                            <input type="text" name="role" hidden  value="{{$user->role}}">
                            
                            <!-- <div class="col-12">
                                <label class="form-label">Role:</label>
                                <select class="form-select w-50" id="role" name="role" value="{{$user->role}}">
                                    <option value="">--select--</option>
                                    <option value="user"{{ $user->role == 'user' ? ' selected' : '' }}>User</option>
                                    <option value="admin"{{ $user->role == 'admin' ? ' selected' : '' }}>Admin</option>


                                 </select>
                            </div> -->


                            <div class="col-12">
                                <button id="updateButton" class="btn btn-primary px-4">Update</button>
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