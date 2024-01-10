@extends('layouts.dashboard_header')


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
                    url: '{{ route('admin.client.update', ['id' => '']) }}' + updateId,

                    data: formData,
                    success: function(response) {

                        console.log(formData);

                        if (response.status_code == '200') {
                            toastr.success(response.message);
                            setTimeout(function() {
                                 window.location.href = '{{ route('admin.show.conferences') }}'; 
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
        <div class="breadcrumb-title pe-3">Conferences</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;">
                            <i class="bi bi-grid-fill"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Conference</li>
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
                    <h5 class="mb-0">Update New Conferences</h5>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">


                        <form id="myForm" class="row g-3">
                        @csrf

                        <input type="text"  hidden value="{{$user->id}}" id="userid"  >

                            <div class="col-12">
                                <label class="form-label">Conferences</label>


                                <input type="text" class="form-control" name="conference" placeholder="Enter Conference" readonly value="{{$user->conference ?? ' '}}">


                            </div>
                            <div class="col-12">
                                <label class="form-label">Article:</label>
                                <input type="text" class="form-control" name="article" readonly placeholder="Enter Article" value="{{$user->article ?? ' '}}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Client Name:</label>
                                <input type="text" class="form-control" value="{{$user->name ?? ''}}" readonly name="name" placeholder="Enter Client Name">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" readonly value="{{$user->email ?? ''}}" name="email" placeholder="Enter Email">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" value="{{$user->country ?? ''}}" placeholder="Enter Country">
                            </div>


                            <div class="col-12">
                                <label class="form-label">Client Status</label>
                                <select class="form-select" name="client_status_id" id="client_status_select">

                                    <option value="">--Choose--</option>
                                    @foreach ($clientStatuses as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div id="followup_fields" style="display: none;">
                                <!-- Add your additional input fields here -->
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <input type="text" id="articleInput2" hidden="">
                                        <input type="text" id="conferenceInput2" hidden="">
                                        <input type="text" id="emailInput2" hidden="">

                                        <label class="label">Follow up Date</label>
                                        <input type="date" class="form-control" id="followup_date" name="followup_date">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Followup Type</label>
                                        <select class="form-control" name="followup_type" id="followup_type">
                                            <option value="">--choose one--</option>
                                            <option value="payment">Payment</option>
                                            <option value="document">Document</option>
                                            <option value="reference">Reference</option>
                                            <option value="confirmation">Confirmation</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        

                                        <label class="label">Note</label>
                                        <textarea id="note" name="note"></textarea>
                                    </div>
                                </div>
                                <!-- Example: -->
                            </div>


                            <div class="col-12">
                                <label class="form-label">FeebBack</label>
                                <textarea name="comment" class="col-md-12" >{{$user->comment}}</textarea>
                            </div>

                         






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