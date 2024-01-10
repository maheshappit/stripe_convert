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

                <form class="searchbar d-flex">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control" id="search" type="text" placeholder="Type here to search" name="search">

                    <!-- Search Button -->
                    <button type="submit" id="search-btn" class="btn btn-primary position-absolute top-50 translate-middle-y end-0">
                        <i class="bi bi-search"></i> Search
                    </button>

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
                            <a class="dropdown-item" href="{{route('home')}}">
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
                            <a class="dropdown-item" href="{{ route('logout') }}" >
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
                    <a href="{{route('home')}}">


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
                            <a href="{{route('user.add.conference')}}">
                                <i class="bi bi-circle"></i>
                                Add New
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user.show.upload')}}">
                                <i class="bi bi-circle"></i>
                                Upload
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user.showall.conferences')}}">
                                <i class="bi bi-circle"></i>
                                Conference List
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div class="menu-title">Status</div>
                    </a>
                    <ul>
                        <li>
                            <a href="positive.html">
                                <i class="bi bi-circle"></i>
                                Positive
                            </a>
                        </li>
                        <li>
                            <a href="Negative.html">
                                <i class="bi bi-circle"></i>
                                Negative
                            </a>
                        </li>
                        <li>
                            <a href="follow-up.html">
                                <i class="bi bi-circle"></i>
                                Follow up
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
                </li> -->
                <!-- <li>
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
                </li> -->
                <!-- <li>
                    <a href="timesheet.html">
                        <div class="parent-icon">
                            <i class="bi bi-alarm-fill"></i>
                        </div>
                        <div class="menu-title">Timesheet</div>
                    </a>
                </li> -->
                <li>
                    <a href="{{route('user.show.report')}}">
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
</body>

</html>