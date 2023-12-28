<!DOCTYPE html>
<html lang="en" class="semi-dark">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
        <!--plugins-->
        <link href="public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
        <link href="public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
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
        <title>Stripe Conferences</title>
        <style>
      label {
        margin-left: 20px;
      }
      #datepicker {
        width: 180px;
      }
      #datepicker > span:hover {
        cursor: pointer;
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
                                        <small class="mb-0 dropdown-user-designation">Admin</small>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="dashboard.html">
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
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>
                                            <div class="ms-3">
                                                <span>Logout</span>
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
                            <a href="dashboard.html">
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
                                    <a href="Add-new.html">
                                        <i class="bi bi-circle"></i>
                                        Add New
                                    </a>
                                </li>
                                <li>
                                    <a href="upload.html">
                                        <i class="bi bi-circle"></i>
                                        Upload
                                    </a>
                                </li>
                                <li>
                                    <a href="Conferences-list.html">
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
                        <li>
                            <a href="timesheet.html">
                                <div class="parent-icon">
                                    <i class="bi bi-alarm-fill"></i>
                                </div>
                                <div class="menu-title">Timesheet</div>
                            </a>
                        </li>
                        <li>
                            <a href="report.html">
                                <div class="parent-icon">
                                    <i class="bi bi-bar-chart-line-fill"></i>
                                </div>
                                <div class="menu-title">Reports</div>
                            </a>
                        </li>
                        <li>
                            <a href="contact.html" target="_blank">
                                <div class="parent-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="menu-title">Contact Us</div>
                            </a>
                        </li>
                    </ul>
                    <!--end navigation-->
                </aside>
            <!--end sidebar -->
            <!--start content-->
            <main class="page-content">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="fs-4 pe-3">Today's Conference</div>
                    <div class="ms-auto">
                        <div id="reportrange" style="
                background: #fff;
                cursor: pointer;
                padding: 5px 10px;
                border: 1px solid #ccc;
                width: 100%;
              ">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
                            <span></span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-pink p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">All Conference</p>
                                        <h4 class="text-white fs-1">52</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-purple p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Collected Data</p>
                                        <h4 class="text-white fs-1">15</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-success p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Sent Mail</p>
                                        <h4 class="text-white fs-1">05</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-orange p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Pending Mail</p>
                                        <h4 class="text-white fs-1">100</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="fs-4 pe-3">Today's Mail</div>
                    <div class="ms-auto">
                        <div id="reportrange" style="
                background: #fff;
                cursor: pointer;
                padding: 5px 10px;
                border: 1px solid #ccc;
                width: 100%;
              ">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
                            <span></span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-pink p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Sent</p>
                                        <h4 class="text-white fs-1">50</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-purple p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Pending</p>
                                        <h4 class="text-white fs-1">15</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-success p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Positive</p>
                                        <h4 class="text-white fs-1">05</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-orange p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Negative</p>
                                        <h4 class="text-white fs-1">0</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="fs-4 pe-3">Today's Lead Pipelines</div>
                    <div class="ms-auto">
                        <div id="reportrange" style="
                background: #fff;
                cursor: pointer;
                padding: 5px 10px;
                border: 1px solid #ccc;
                width: 100%;
              ">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
                            <span></span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-pink p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Follow Up</p>
                                        <h4 class="text-white fs-1">50</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-purple p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Converted</p>
                                        <h4 class="text-white fs-1">15</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-success p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Rejected</p>
                                        <h4 class="text-white fs-1">05</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card overflow-hidden rounded-4">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-orange p-4">
                                    <div class="w-50 p-2">
                                        <p class="text-white fs-6">Payment Status</p>
                                        <h4 class="text-white fs-1">100</h4>
                                    </div>
                                    <div class="w-50 p-3">
                                        <p class="mb-3 text-white text-end">
                                            <a href="#"></a>
                                            View
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="card rounded-4 w-100">
                            <div class="card-header bg-transparent border-0">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <h6 class="mb-0 fs-2 fw-bold">All Conferences</h6>
                                    </div>
                                    <!-- <div class="col">
                    <div
                      class="d-flex align-items-center justify-content-end gap-3 cursor-pointer"
                    >
                      <div class="dropdown">
                        <a
                          class="dropdown-toggle dropdown-toggle-nocaret"
                          href="#"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i
                            class="bx bx-dots-horizontal-rounded font-22 text-option"
                          ></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a class="dropdown-item" href="javascript:;"
                              >Action</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="javascript:;"
                              >Another action</a
                            >
                          </li>
                          <li>
                            <hr class="dropdown-divider" />
                          </li>
                          <li>
                            <a class="dropdown-item" href="javascript:;"
                              >Something else here</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div> -->
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="best-product p-2 mb-3">
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">1</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Cancer Oncology Conference
                                                    <span class="float-end">95%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">2</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Neurology Alzheimers Disease
                                                    <span class="float-end">75%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 70%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">3</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Renewable Energys & Sustainable Development
                                                    <span class="float-end">65%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">4</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Traditional Alternative Medicine
                                                    <span class="float-end">55%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-orange" role="progressbar" style="width: 50%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">5</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Medical Health Pharmaceutical Industry
                                                    <span class="float-end">45%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-purple" role="progressbar" style="width: 40%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">6</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Cell Science Molecular Biology
                                                    <span class="float-end">35%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 30%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">7</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Food Technology Nutrition
                                                    <span class="float-end">25%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-pink" role="progressbar" style="width: 20%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="best-product-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box border">
                                                <span class="badge bg-primary">8</span>
                                            </div>
                                            <div class="product-info flex-grow-1">
                                                <p class="product-name mb-0 mt-2 fs-5">
                                                    Nursing, Midwifery Womens Health
                                                    <span class="float-end">15%</span>
                                                </p>
                                                <div class="progress-wrapper">
                                                    <div class="progress" style="height: 5px;">
                                                        <div class="progress-bar bg-dark" role="progressbar" style="width: 10%;"></div>
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
            </main>
            <a href="javaScript:;" class="back-to-top">
                <i class="bx bxs-up-arrow-alt"></i>
            </a>
        </div>
        <!--end wrapper-->
        <!-- Bootstrap bundle JS -->
        <script src="public/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="public/assets/js/jquery.min.js"></script>
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
        <!-- Datepicker js -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
