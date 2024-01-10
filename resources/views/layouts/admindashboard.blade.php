<!DOCTYPE html>
<html lang="en" class="semi-dark">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- data table links -->
    <!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> -->



    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>



    <!-- //toastr links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png">
    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">

    <link href="{{asset('public/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
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
    <title>Stripe Conferences</title>
    <style>
        label {
            margin-left: 20px;
        }

        #datepicker {
            width: 180px;
        }

        #datepicker>span:hover {
            cursor: pointer;
        }

        .toast-message {
            color: white
        }


        .toast-error {
            background-color: #dc3545;
            /* Red color for error */
            /* Red color for error */
        }

        .toast-success {
            background-color: #28a745;
            /* Green color for success */
        }

        @keyframes toastFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes toastFadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>


    <style>
        .add-button {
            width: 100px;
        }

        table.dataTable>tbody>tr {
            /* display: inline-block; */
            white-space: nowrap;
            /* Prevent line breaks within the row */
            margin-right: 10px;
            height: auto;
            /* Add spacing between rows if necessary */

        }

        .custom-button {
            padding: 8px 16px;
            font-size: 14px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .custom-button:hover {
            background-color: darkblue;
        }

        thead {
            border-top: none;
            font-size: small;
        }

        tbody tr>td {
            border-top: none;
            font-size: small;
        }

        .hidden {
            display: none;
        }



        .toast-message {
            color: black
        }

        .modal {
            position: fixed;
            top: -145px !important;
            left: 0;
            width: 100%;
            height: 810px !important;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            width: 30px
        }

        .close:hover {
            color: black;
        }

        .ViewCommentsModal {
            display: none;
            position: fixed;
            top: -138px;
            left: 0;
            width: 100%;
            height: 500% !important;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            max-width: 80%;
            max-height: 80%;
            overflow-y: auto;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }


        .comment-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            /* Add more styling as needed */
        }

        .ViewFollowModal {
            display: none;
            position: fixed;
            top: -138px;
            left: 0;
            width: 100%;
            height: 280% !important;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            max-width: 80%;
            max-height: 80%;
            overflow-y: auto;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }


        .comment-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            /* Add more styling as needed */
        }

        .add-button {
            top: 0;
            right: 150px;
            margin: 10px;
            /* Adjust the margin as needed */
        }

        .button-container {
            display: flex;
            gap: 10px;
            /* Adjust the gap as needed */
        }

        .label {
            width: 21rem !important;

        }

        .md-6 {
            display: flex;

        }

        .row {
            display: flex !important;
            margin-left: 0px !important;
            margin-right: 0px !important;
            align-items: center !important;

        }

        .form-control {
            width: auto !important;
            display: inline;
        }

        /* #myForm2{
        display: flex !important;
    } */
    </style>


</head>






<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
                    <i class="bi bi-list"></i>
                </div>
                <form class="searchbar">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control" type="text" placeholder="Type here to search">
                    <div class="position-absolute top-50 translate-middle-y search-close-icon">
                        <i class="bi bi-x-lg"></i>
                    </div>
                </form>
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item search-toggle-icon d-flex d-lg-none">
                            <a class="nav-link" href="javascript:;">
                                <div class="">
                                    <i class="bi bi-search"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex"></li>
                        <li class="nav-item dark-mode d-none d-sm-flex">
                            <a class="nav-link dark-mode-icon" href="javascript:;">
                                <div class="">
                                    <i class="bi bi-moon-fill"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                    </ul>
                </div>
                <div class="dropdown dropdown-user-setting">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-cente
                      r gap-3">
                            <img src="public/assets/images/avatars/avatar-1.png" class="user-img" alt="">
                            <div class="d-none d-sm-block">
                                <p class="user-name mb-0">Welcome</p>

                                @if(auth()->check())
                                <small class="mb-0 dropdown-user-designation">{{ auth()->user()->name }}</small>
                                @else
                                <small class="mb-0 dropdown-user-designation">Welcome, Guest!</small>
                                @endif
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <span>Home</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="profile.html">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <i class="bi bi-gear-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <span>Profile</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <span class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </span>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->
        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="public/assets/images/logo.jpg" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">Stripe</h4>
                </div>
                <div class="toggle-icon ms-auto">
                    <i class="bi bi-list"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                        <div class="parent-icon">
                            <i class="bi bi-house-fill"></i>
                        </div>
                        <div class="menu-title">Home</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class="bi bi-grid-fill"></i>
                        </div>
                        <div class="menu-title">Conferences</div>
                    </a>
                    <ul>

                        <li>
                            <a href="{{route('admin.show.upload')}}">
                                <i class="bi bi-circle"></i>
                                Upload
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.show.conferences')}}">
                                <i class="bi bi-circle"></i>
                                Conference List
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div class="menu-title">Status</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.show.positive')}}">
                                <i class="bi bi-circle"></i>
                                Positive
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.show.negative')}}">
                                <i class="bi bi-circle"></i>
                                Negative
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.show.followup')}}">
                                <i class="bi bi-circle"></i>
                                Follow up
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.show.neutral')}}">
                                <i class="bi bi-circle"></i>
                                Neutral
                            </a>
                        </li>


                        <li>
                            <a href="{{route('admin.show.unsubscribe')}}">
                                <i class="bi bi-circle"></i>
                                Un Subscribe
                            </a>
                        </li>


                        <li>
                            <a href="{{route('admin.show.online')}}">
                                <i class="bi bi-circle"></i>
                                Online Presentation
                            </a>
                        </li>


                        <li>
                            <a href="payment.html">
                                <i class="bi bi-circle"></i>
                                Wait for Payment
                            </a>
                        </li>
                        <li>
                            <a href="rejected.html">
                                <i class="bi bi-circle"></i>
                                Rejected
                            </a>
                        </li>
                        <li>
                            <a href="converted.html">
                                <i class="bi bi-circle"></i>
                                Converted
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div class="menu-title">Speakers</div>
                    </a>
                    <ul>
                        <li>
                            <a href="add-speaker.html">
                                <i class="bi bi-circle"></i>
                                Add Speaker
                            </a>
                        </li>
                        <li>
                            <a href="all-speakers.html">
                                <i class="bi bi-circle"></i>
                                All Speaker
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="timesheet.html">
                        <div class="parent-icon">
                            <i class="bi bi-alarm-fill"></i>
                        </div>
                        <div class="menu-title">Timesheet</div>
                    </a>
                </li> -->
                <li>
                    <a href="{{route('admin.show.report')}}">
                        <div class="parent-icon">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>
                        <div class="menu-title">Reports</div>
                    </a>
                </li>
                <!-- <li>
                    <a href="contact.html" target="_blank">
                        <div class="parent-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="menu-title">Contact Us</div>
                    </a>
                </li> -->
            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->
        <!--start content-->

        @yield('content')






        <div class="conatiner">
            <div id="ViewCommentsModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <!-- <form id="myForm2" class="hidden"> -->
                    <div class="row">
                        <form>
                            @csrf
                            <div id="myForm2" class="hidden">
                                <div class="md-6 align-items-center d-inline-flex">


                                    <input type="text" id="articleInput" hidden>
                                    <input type="text" id="conferenceInput" hidden>
                                    <input type="text" id="emailInput" hidden>

                                    <input type="text" id="nameInput" hidden>


                                    <label class="label">Select Client Status</label>
                                    <select class="form-select w-100" id="client_status_id">

                                        <option value="">--Choose--</option>

                                        <option value="1">Positive</option>
                                        <option value="2">Negative</option>

                                    </select>
                                </div>
                                <div class="d-inline">
                                    <span class="col-md-6">
                                        <label>Write comment</label>
                                        <input class="form-control" type="text" id="comment">
                                    </span>
                                </div>

                            </div>
                        </form>
                        <div class="d-inline">
                            <button class="add-button btn btn-primary btn-sm" id="showFormBtn2">Add</button>
                        </div>
                        <span class="close" onclick="closeViewModal()">&times;</span>

                    </div>






                    <div id="commentsContainer">
                        <!-- Comments will be dynamically inserted here -->
                    </div>
                </div>
            </div>

            <div id="ViewFollowModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <!-- <form id="myForm2" class="hidden"> -->
                    <div class="row">
                        <form>
                            @csrf
                            <div id="followupForm" class="hidden">
                                <div class="align-items-center d-inline-flex">


                                <input type="text" id="articleInput2" hidden>
                                    <input type="text" id="conferenceInput2" hidden>
                                    <input type="text" id="emailInput2" hidden>
                                    <input type="text" id="nameInput2" hidden>



                                    <label class="label">Follow up Date</label>
                                    <input type="date" class="form-control" id="followup_date" name="followup_date">

                                    <label>Followup Type</label>
                                        <select class="form-select w-50" name="followup_type" id="followup_type">
                                            <option value="">--choose one--</option>
                                            <option value="payment">Payment</option>
                                            <option value="document">Document</option>
                                            <option value="reference">reference</option>
                                            <option value="confirmation">Confirmation</option>

                                        </select>


                                        <label>Notes</label>
                                        <textarea id="note" name="note"></textarea>
                                      
                                </div>
                                

                            </div>
                        </form>
                        <div class="d-inline">

                            <button class="add-button btn btn-primary btn-sm" id="formsubmitBtn">Add</button>
                        </div>
                        <span class="close" onclick="closeFollowViewModal()">&times;</span>
                    </div>






                    <div id="FollowupcommentsContainer">
                        <!-- Comments will be dynamically inserted here -->
                    </div>
                </div>
            </div>


            <div id="ViewFollowNegativeModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <!-- <form id="myForm2" class="hidden"> -->
    <div class="row">
        <form>
            @csrf
            <div id="NegativefollowupForm" class="hidden">
                <div class="align-items-center d-inline-flex">


                <input type="text" id="articleInput2" hidden>
                    <input type="text" id="conferenceInput2" hidden>
                    <input type="text" id="emailInput2" hidden>
                    <input type="text" id="nameInput2" hidden>



                    <label class="label">Follow up Date</label>
                    <input type="date" class="form-control" id="negative_followup_date" name="negative_followup_date">

                    <label>Followup Type</label>
                        <select class="form-select w-50" name="negative_followup_type" id="negative_followup_type">
                            <option value="">--choose one--</option>
                            <option value="payment">Payment</option>
                            <option value="document">Document</option>
                            <option value="reference">reference</option>
                            <option value="confirmation">Confirmation</option>

                        </select>


                        <label>Notes</label>
                        <textarea  id="negative_note" name="negative_note"></textarea>
                      
                </div>
                

            </div>
        </form>
        <div class="d-inline">

            <button class="add-button btn btn-primary btn-sm" id="formNegativesubmitBtn">Add</button>
        </div>
        <span class="close" onclick="closeFollowViewModal()">&times;</span>
    </div>






    <div id="FollowupNegativecommentsContainer">
                        <!-- Comments will be dynamically inserted here -->
                    </div>
</div>
</div>


        </div>




        <a href="javaScript:;" class="back-to-top">
            <i class="bx bxs-up-arrow-alt"></i>
        </a>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap bundle JS -->
    <script src="public/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="public/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="public/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="public/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="public/assets/js/pace.min.js"></script>
    <script src="public/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="public/assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="public/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <!--app-->
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/index4.js"></script>
    <script>
        new PerfectScrollbar(".best-product")
    </script>

    <script type="text/javascript">
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add an event listener to the button
            document.getElementById("showFormBtn2").addEventListener("click", function() {

                // Get the form element
                var form2 = document.getElementById("myForm2");

                // Toggle the "hidden" class to show/hide the form
                form2.classList.toggle("hidden");

                // Change the button text from "Add" to "Save"
                var buttonText = this.innerText;
                this.innerText = buttonText === "Add" ? "Save" : "Add";
            });
        });

        function saveForm() {
            var formData = $('#myForm2').serialize(); // Serialize form data
            const article_id = $('#articleInput').val();
            const email_id = $('#emailInput').val();
            const conference_id = $('#conferenceInput').val();
            const client_status_id = $('#client_status_id').val();





            const comment = $('#comment').val();





            $.ajax({
                type: 'POST',
                url: '{{route('admin.add.comments')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    article: article_id,
                    email: email_id,
                    client_status_id: client_status_id,
                    comment: comment,
                    conference: conference_id,

                },
                success: function(response) {
                    // Handle success, if needed
                    console.log(response);
                    toastr.success(response.message);

                    $('#client_status_id').val('');
                    $('#comment').val('');

                    console.log(response.comments);


                    updateModalContent2(response.comments);


                    // If submission is successful, hide the form and change button text back to "Add"
                    $('#myForm2').addClass('hidden');
                    $('#showFormBtn2').text('Add');
                },
                error: function(xhr, status, error) {

                    var errors = xhr.responseJSON.errors;
                    handleValidationErrors(errors);
                },
            });
        }

        function handleValidationErrors(errors) {
            // Display validation errors as toasts
            for (var field in errors) {
                if (errors.hasOwnProperty(field)) {
                    toastr.error(errors[field][0]);
                }
            }
        }


        // Add an event listener to the "Save" button
        document.getElementById("showFormBtn2").addEventListener("click", function() {
            // Check if the button text is "Save" and submit the form if it is
            if (this.innerText === "Save") {
                saveForm();
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add an event listener to the button
            document.getElementById("formsubmitBtn").addEventListener("click", function() {

                // Get the form element


                var followupForm = document.getElementById("followupForm");

                // Toggle the "hidden" class to show/hide the form
                followupForm.classList.toggle("hidden");

                // Change the button text from "Add" to "Save"
                var mybutton = this.innerText;
                this.innerText = mybutton === "Add" ? "Save" : "Add";
            });
        });




        function updateModalFollowupContent2(followups) {
            // Get the comments container
            var commentsContainer = document.getElementById('FollowupcommentsContainer');

            // Clear existing content
            commentsContainer.innerHTML = '';

            // Iterate through comments and append them to the container
            followups.forEach(followup => {
                // Create a card element for each comment
                var cardDiv = document.createElement('div');
                cardDiv.classList.add('comment-card'); // Add a CSS class for styling if needed

                cardDiv.innerHTML = `
        <p><b>Follow Up Date:</b> <span style="margin-right:50px" id="clientStatus${comment.id}">${followup.followup_date}</span>
    
        <span style="margin-right:50px"> <b> Follow Up Type:</b> ${followup.followup_type} </span>
       <span style="margin-right:50px"> <b>Followup Email:</b> ${followup.email} </span>
        </p>
          <b> Note: </b> ${followup.note}
        </p>

        `;




                // Append the card to the container
                commentsContainer.appendChild(cardDiv);
            });
        }


        function saveForm2() {
            var formData = $('#followupForm').serialize(); // Serialize form data
            const article_id = $('#articleInput2').val();


            const email_id = $('#emailInput2').val();
            const conference_id = $('#conferenceInput2').val();
            const client_status_id = $('#client_status_id2').val();
            const comment = $('#comment').val();
            const followup_date = $('#followup_date').val();
            const followup_type = $('#followup_type').val();
            const note = $('#note').val();
            const name = $('#nameInput2').val();






            $.ajax({
                type: 'POST',
                url: '{{route('admin.add.followupdata')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    article: article_id,
                    email: email_id,
                    conference: conference_id,
                    followup_date: followup_date,
                    followup_type: followup_type,
                    note: note,
                    name: name

                },
                success: function(response) {
                    // Handle success, if needed
                    console.log(response);
                    toastr.success(response.message);

                    $('#client_status_id').val('');
                    $('#comment').val('');
                    $('#emailInput2').val();
                    $('#conferenceInput2').val();
                    $('#client_status_id2').val();
                    $('#comment').val();
                    $('#followup_date').val();
                    $('#followup_type').val();
                    $('#note').val();

                    console.log(response.followups);


                    updateModalFollowupContent2(response.followups);


                    // If submission is successful, hide the form and change button text back to "Add"
                    $('#followupForm').addClass('hidden');
                    $('#formsubmitBtn').text('Add');
                },
                error: function(xhr, status, error) {

                    var errors = xhr.responseJSON.errors;
                    handleValidationErrors(errors);
                },
            });
        }

        function handleValidationErrors(errors) {
            // Display validation errors as toasts
            for (var field in errors) {
                if (errors.hasOwnProperty(field)) {
                    toastr.error(errors[field][0]);
                }
            }
        }


        // Add an event listener to the "Save" button
        document.getElementById("formsubmitBtn").addEventListener("click", function() {
            // Check if the button text is "Save" and submit the form if it is
            if (this.innerText === "Save") {
                saveForm2();
            }
        });
    </script>






    <script>
        function openViewModal() {
            var viewmodal = document.getElementById('ViewCommentsModal');
            viewmodal.style.display = 'block';
        }

        function closeViewModal() {
            var viewmodal = document.getElementById('ViewCommentsModal');
            viewmodal.style.display = 'none';
        }


        // Function to update modal content with comments
        function updateModalContent2(comments) {
            // Get the comments container
            var commentsContainer = document.getElementById('commentsContainer');

            // Clear existing content
            commentsContainer.innerHTML = '';

            // Iterate through comments and append them to the container
            comments.forEach(comment => {
                // Create a card element for each comment
                var cardDiv = document.createElement('div');
                cardDiv.classList.add('comment-card'); // Add a CSS class for styling if needed

                cardDiv.innerHTML = `
        <p><b>Client Status:</b> <span style="margin-right:50px" id="clientStatus${comment.id}">${comment.name}</span>
    
        <span style="margin-right:50px"> <b> Email:</b> ${comment.email} </span>
       <span style="margin-right:50px"> <b> Date:</b> ${comment.comment_created_date} </span>
        </p>
          <b> Comment: </b> ${comment.comment}
        </p>

        `;

                var clientStatusSpan = cardDiv.querySelector(`#clientStatus${comment.id}`);
                if (comment.name === 'Positive') {
                    clientStatusSpan.style.color = 'green';
                    // Add more styles as needed
                } else if (comment.name === 'Negative') {
                    clientStatusSpan.style.color = 'red';
                    // Add more styles as needed
                }


                // Append the card to the container
                commentsContainer.appendChild(cardDiv);
            });
        }



        function makeAjaxCall(conference, article, email) {
            const url = `comments?conference=${conference}&article=${article}&email=${email}`;

            // Make an AJAX request to fetch comments
            fetch(url) // Update the URL to your actual API endpoint
                .then(response => response.json())
                .then(data => {

                    console.log(data.comments[0].article);
                    document.getElementById('articleInput').value = data.comments[0].article;
                    document.getElementById('conferenceInput').value = data.comments[0].conference;
                    document.getElementById('emailInput').value = data.comments[0].email;

                    // Update the modal content with comments
                    updateModalContent2(data.comments);
                })
                .catch(error => console.error('Error fetching comments:', error));

            // Display the modal
            document.getElementById('ViewCommentsModal').style.display = 'block';
        }

        function makeAjaxCall2(conference, article, email) {
            // Assuming you are using the XMLHttpRequest object for AJAX
            var xhr = new XMLHttpRequest();

            console.log(conference, article, email);


            const url = `comments?conference=${conference}&article=${article}&email=${email}`;

            // Configure the AJAX request
            xhr.open('GET', url, true);

            // Set up a callback function to handle the response
            xhr.onload = function(response) {

                console.log(response);
                if (xhr.status == 200) {
                    // If the AJAX request is successful, call openModal()
                    openViewModal();
                } else {
                    // Handle errors if the AJAX request fails
                    console.error('AJAX request failed');
                }
            };

            // Send the AJAX request
            xhr.send();
        }

        // Call the makeAjaxCall() function to initiate the AJAX request
    </script>


</body>

</html>