@extends('layouts.admindashboard')


@section('content')

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
                <span>December 11, 2023 - January 9, 2024</span>
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
                            <h4 class="text-white fs-1">{{$today_conferences_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$today_data_collected_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$today_sent_mail_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$today_pending_mail_count ?? ''}}</h4>
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
                <span>December 11, 2023 - January 9, 2024</span>
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
                            <h4 class="text-white fs-1">{{$today_sent_mail_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$today_pending_mail_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$positive_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$negative_count ?? ''}}</h4>
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
                <span>December 11, 2023 - January 9, 2024</span>
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
                            <h4 class="text-white fs-1">{{$followup_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$converted_count ?? ''}}</h4>
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
                            <h4 class="text-white fs-1">{{$rejected_count ?? ''}}</h4>
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
                            <p class="text-white fs-6">Waiting For Payment </p>
                            <h4 class="text-white fs-1">{{$waiting_for_payment_count ?? ''}}</h4>
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
                    <div class="best-product p-2 mb-3 ps ps--active-y">

                        @foreach($all_conferences as $conference)

                        <div class="best-product-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <span class="badge bg-primary">{{ $loop->index + 1 }}</span>

                                </div>
                                <div class="product-info flex-grow-1">
                                    <p class="product-name mb-0 mt-2 fs-5">
                                        {{$conference->conference}}
                                        <span class="float-end">{{$conference->count}}</span>
                                    </p>
                                    <div class="progress-wrapper">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endforeach


                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 420px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 315px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection