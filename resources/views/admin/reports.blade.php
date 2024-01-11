@extends('layouts.admindashboard')

@section('content')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
    <!--plugins-->
    <link href="public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <link href="public/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet">
    <link href="public/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet">
    <link href="public/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet">
    <link rel="public/stylesheet" href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="public/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="public/assets/css/style.css" rel="stylesheet">
    <link href="public/assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- loader-->
    <link href="public/assets/css/pace.min.css" rel="stylesheet">
    <!--Theme Styles-->
    <link href="public/assets/css/dark-theme.css" rel="stylesheet">
    <link href="public/assets/css/light-theme.css" rel="stylesheet">
    <link href="public/assets/css/semi-dark.css" rel="stylesheet">
    <link href="public/assets/css/header-colors.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/js/pace.min.js"></script>
    <script src="public/assets/plugins/datetimepicker/js/legacy.js"></script>
    <script src="public/assets/plugins/datetimepicker/js/picker.js"></script>
    <script src="public/assets/plugins/datetimepicker/js/picker.time.js"></script>
    <script src="public/assets/plugins/datetimepicker/js/picker.date.js"></script>
    <script src="public/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
    <title>Stripe Conferences</title>
    <style>
        .dt-buttons {
        background-color: green;
        color: white;
        /* Set text color to ensure visibility */
    }
    </style>
</head>


<script>
    $(document).ready(function() {
        // Initialize DataTable with buttons
        var table = $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $('#clear').click(function(e) {

            $('#start_date').val('');
            $('#end_date').val('');


        })

        // Intercept the form submission
        $('#myForm').submit(function(e) {
            // Prevent the default form submission
            e.preventDefault();
            $('.field-error').text('');

            var f_date = $('#start_date').val();

            var t_date = $('#end_date').val();



            function formatDate(inputDate) {
                const options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                };
                const date = new Date(inputDate);
                return date.toLocaleDateString('en-US', options);
            }

            // Example usage
            const start_date = formatDate(f_date);
            const end_date = formatDate(t_date);

            console.log('end date',t_date);




            // Get form data
            var formData = $(this).serializeArray();

            // Add additional variable to the payload

            // Make an Ajax request
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.report.download') }}", // Use the route function to generate the URL
                data: formData,
                success: function(response, status) {

                    console.log('res datta');

                    $("#usersCount").text(response.users_count);
                    $("#inserted_count").text(response.inserted_count);
                    $("#updated_count").text(response.updated_count);
                    $("#downloaded_count").text(response.downloaded_count);

                    // Clear existing table data
                    table.clear().draw();


                    // Populate the table with the new data
                    $.each(response.data, function(index, item) {
                        var created_At = new Date(item.user_created_at);
                        var formattedCreatedAt = created_At;

                        table.row.add([
                            start_date + ' To ' + end_date,
                            item.name,
                            item.conference,
                            item.inserted_count,
                            item.updated_count,
                            item.download_count,
                            item.email_pending_count,
                            item.email_sent_count,
                            item.client_positive_count,
                            item.client_negative_count,



                        ]).draw();
                    });
                },
                error: function(xhr, status, error) {

                    // Handle errors, including validation errors
                    var errors = xhr.responseJSON.errors;

                    // Display errors in your form
                    displayErrors(errors);
                },
                complete: function(xhr, status) {

                    if (xhr.status == '422') {

                        var errors = xhr.responseJSON.errors;

                        // Display errors in your form
                        displayErrors(errors);

                    } else if (xhr.status == '200') {
                        $('#error-start_date').text('');
                        $('#error-end_date').text('');



                    } else {
                        alert('somthing went wrong');
                    }
                    // xhr.status contains the status code
                }
            });
        });

        function displayErrors(errors) {
            // Clear previous error messages
            // $('.message').remove();

            // Display new error messages
            $.each(errors, function(key, value) {
                // Assuming you have elements with IDs like 'error-start_date' and 'error-end_date'
                $('#' + 'error-' + key).html('<p class="error-message">' + value[0] + '</p>');
            });
        }
    });
</script>


<!-- <script>
    $(document).ready(function() {
        // Initialize DataTable with buttons
     
        var table = $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $('#clear').click(function(e) {

            $('#user_id').val('All');
            $('#end_date').val('');


        })

        // Intercept the form submission
        $('#myForm').submit(function(e) {
            // Prevent the default form submission
            e.preventDefault();
            $('.field-error').text('');

            var f_date = $('#start_date').val();

            var t_date = $('#end_date').val();



            function formatDate(inputDate) {
                const options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                };
                const date = new Date(inputDate);
                return date.toLocaleDateString('en-US', options);
            }

            // Example usage
            const start_date = formatDate(f_date);
            const end_date = formatDate(t_date);

            console.log('end date',t_date);




            // Get form data
            var formData = $(this).serializeArray();

            // Add additional variable to the payload

            // Make an Ajax request
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.report.download') }}", // Use the route function to generate the URL
                data: formData,
                success: function(response, status) {

                    console.log('res datta');

                    $("#usersCount").text(response.users_count);
                    $("#inserted_count").text(response.inserted_count);
                    $("#updated_count").text(response.updated_count);
                    $("#downloaded_count").text(response.downloaded_count);

                  

                    // Clear existing table data
                    table.clear().draw();


                    // Populate the table with the new data
                    $.each(response.data, function(index, item) {
                        var createdAt = new Date(item.created_at);
                        var formattedCreatedAt = createdAt.toISOString().split('T')[0];

                        table.row.add([
                            start_date + ' To ' + end_date,
                            item.name,
                            item.inserted_count,
                            item.updated_count,
                            item.download_count,

                        ]).draw();
                    });
                },
                error: function(xhr, status, error) {

                    // Handle errors, including validation errors
                    var errors = xhr.responseJSON.errors;

                    // Display errors in your form
                    displayErrors(errors);
                },
                complete: function(xhr, status) {

                    if (xhr.status == '422') {

                        var errors = xhr.responseJSON.errors;

                        // Display errors in your form
                        displayErrors(errors);

                    } else if (xhr.status == '200') {
                        $('#error-start_date').text('');
                        $('#error-end_date').text('');



                    } else {
                        alert('somthing went wrong');
                    }
                    // xhr.status contains the status code
                }
            });
        });

        function displayErrors(errors) {
            // Clear previous error messages
            // $('.message').remove();

            // Display new error messages
            $.each(errors, function(key, value) {
                // Assuming you have elements with IDs like 'error-start_date' and 'error-end_date'
                $('#' + 'error-' + key).html('<p class="error-message">' + value[0] + '</p>');
            });
        }
    });
</script> -->

<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {

            var start_date = document.getElementById('start_date');
            var desiredStartDate = new Date(start.format('YYYY-MM-DD'));
            var formattedStartDate = desiredStartDate.toISOString().split('T')[0];
            start_date.value = formattedStartDate;
            start_date.innerHTML = start.format('YYYY-MM-DD');


            var end_date = document.getElementById('end_date');
            var desiredEndDate = new Date(end.format('YYYY-MM-DD'));
            var formattedEndDate = desiredEndDate.toISOString().split('T')[0];
            end_date.value = formattedEndDate;
            end_date.innerHTML = end.format('YYYY-MM-DD');


            console.log('Start Date: ' + start.format('YYYY-MM-DD'));
            console.log('End Date: ' + end.format('YYYY-MM-DD'));
            $('#reportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange2').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>

<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Home</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Report</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Reports</h5>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <form class="row g-3" id="myForm" method="post">
                            @csrf
                            <div class="col-12 col-md-3">
                                <label class="form-label">User</label>
                                <select id="user_id" name="user_id" class="user_id form-select" style="height: 30;">
                                    <option value="All">All</option>
                                    @foreach($all_users as $name)
                                    <option value="{{ $name['id'] }}">{{ $name['name'] }}</option>
                                    @endforeach
                                </select>

                            </div>

                            
                            <div class="col-12 col-md-3">
                                <label class="form-label">By Conference Name</label>
                                <select class="form-select" name="conference">
                                    <option value="All"> All</option>
                                    @foreach($all_conferences as $conference)
                                    <option value="{{$conference->name}}">{{ $conference->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label">Created Date</label>
                                <div id="reportrange2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>


            <div>
                <input type="date" id="start_date" hidden name="start_date" />
                <input type="date" id="end_date" hidden name="end_date" />

            </div>

                            </div>
                            <div class="col-12 col-md-1">
                                <button class="btn btn-primary px-4 mt-4">Submit</button>
                            </div>
                            <div class="col-12 col-md-1">
                                <button class="btn btn-secondary px-4 mt-4" id="clear">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 id="usersCount"> {{$users_count ?? ''}}</h3>
                    <p class="mb-0">Total User Count</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-danger text-danger">
                        <i class="bi bi-hdd-fill"></i>
                    </div>
                    <h3 id="inserted_count">{{$inserted_count ?? 0}}</h3>
                    <p class="mb-0"  id="inserted_count">Total Inserted Count</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-success text-success">
                        <i class="bi bi-pie-chart-fill"></i>
                    </div>
                    <h3 id="updated_count">{{$updated_count ?? ''}}</h3>
                    <p class="mb-0">Total Updated Count</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-info text-info">
                        <i class="bi bi-archive-fill"></i>
                    </div>
                    <h3 id="downloaded_count">{{$downloaded_count ?? 0}}</h3>
                    <p class="mb-0">Total Downloaded Count</p>
                </div>
            </div>
        </div>
    </div><!--end row-->
    <div class="card">
        <div class="card-header py-3 bg-transparent">
            <h5 class="mb-0">Admin Report Data</h5>
        </div>
        <div class="card-body">
            <!-- <div class="d-flex align-items-center">
                <label>
                    Show Enteries
                    <select name="dtHorizontalExample_length" aria-controls="dtHorizontalExample" class="form-select form-select-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </label>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control ps-5" type="text" placeholder="search">
                </form>
            </div> -->
            <div class="table-responsive mt-3">
            <table id="dataTable" class="table table-striped table-hover">
        <!-- Table headers go here -->
        <thead>
            <tr>
                <th width="250px;">Date</th>
                <th>UserName</th>
                <th>Conference</th>
                <th>Inserted Count</th>
                <th>Updated Count</th>
                <th>Downloaded Count</th>
                <th>Email Status Pending Count</th>
                <th>Email Status Sent Count</th>
                <th>Client Status Positive Count</th>
                <th>Client Status Negative Count</th>


            </tr>
        </thead>
        <tbody>
            <!-- Table body will be populated using Ajax response -->
        </tbody>
    </table>
            </div>
        </div>
      
    </div>
</main>


@endsection