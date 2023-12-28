@extends('layouts.dashboard_header')

<head>
        
        <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
        <link href="public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
        <link href="public/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet">
        <link href="public/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet">
        <link href="public/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <link href="public/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
        <link href="public/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="public/assets/css/bootstrap-extended.css" rel="stylesheet">
        <link href="publicassets/css/style.css" rel="stylesheet">
        <link href="public/assets/css/icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="public/assets/css/pace.min.css" rel="stylesheet">
        <link href="public/assets/css/dark-theme.css" rel="stylesheet">
        <link href="public/assets/css/light-theme.css" rel="stylesheet">
        <link href="public/assets/css/semi-dark.css" rel="stylesheet">
        <link href="public/assets/css/header-colors.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

        <script src="public/assets/js/bootstrap.bundle.min.js"></script>
            <script src="public/assets/js/jquery.min.js"></script>
            <script src="public/assets/plugins/simplebar/js/simplebar.min.js"></script>
            <script src="public/assets/plugins/metismenu/js/metisMenu.min.js"></script>
            <script src="public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
            <script src="public/assets/js/pace.min.js"></script>
            <script src="public/assets/plugins/datetimepicker/js/legacy.js"></script>
            <script src="public/assets/plugins/datetimepicker/js/picker.js"></script>
            <script src="public/assets/plugins/datetimepicker/js/picker.time.js"></script>
            <script src="public/assets/plugins/datetimepicker/js/picker.date.js"></script>
            <script src="public/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
            <script src="public/assets/js/form-date-time-pickes.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


            <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

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
      

    </head>






    <script>
        $(document).ready(function() {
            var myTable; // Declare a variable to store the DataTable object

    
            myTable = $('#datatable').DataTable({

                "columnDefs": [{
                    "targets": [1], // Assuming "Street" is the second column (index 1)
                    "render": function(data, type, row) {
                        if (type === 'display' && data != null && data.length > 20) {
                            return `<span class="ellipsis">${data.substr(0, 20)}...</span>
                            <span class="more-text" style="display: none;">${data}</span>
                            <button class="show-more">More</button>`;
                        }
                        return data;
                    }
                }],



                dom: 'lBfrtip',
                // 'responsive': true,

                processing: true,
                serverSide: true,
                autoWidth: false,
                recordsTotal: 50,
                ajax: {
                    url: "{{ route('users') }}",
                    data: function(d) {

                        d.db = $('#db').val();
                        d.search=$('#search').val();
                        d.client = $('#client').val();
                        d.country = $('#country').val();
                        d.technology = $('#technology').val();
                        d.speciality = $('#speciality').val();
                        d.designation = $('#designation').val();
                        d.emp_count = $('#emp_count').val();



                        var client_id = $('#client').val();

                        var county_id = $('#country').val();

                        var dba = $('#db').val();

                       var search= d.search=$('#search').val();


                        console.log(search);


                    }
                },

                columns: [{
                        title: 'Serial Number',
                        data: null,
                        "render": function (data, type, row, meta) {
                    // 'meta.row' is the row index, 'meta.settings._iDisplayStart' is the page start index
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
                    },
                    {
                        data: 'create_date',
                        title: 'Create Date'
                    },
                    {
                        data: 'country',
                        title: 'Country'
                    },
                    {
                        data: 'client_name',
                        title: 'Client Name'
                    },
                    {
                        data: 'contact_source',
                        title: 'Contact Source'
                    },
                    {
                        data: 'database_creator_name',
                        title: 'DataBase Creator Name'
                    },
                    {
                        data: 'technology',
                        title: 'Technology'
                    },
                    {
                        data: 'client_speciality',
                        title: 'Client Speciality',
                        "width": "2px",
                        render: function(data, type, row) {
                            if (type === 'display' && data != null && data.length > 10) {
                                return `<span class="ellipsis">${data.substr(0, 10)}...</span>
                            <span class="more-text" style="display: none;">${data}</span>
                            <a class="show-more">More</a>`;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'street',
                        title: 'Street',
                        "width": "2px",
                        render: function(data, type, row) {
                            if (type === 'display' && data != null && data.length > 10) {
                                return `<span class="ellipsis">${data.substr(0, 10)}...</span>
                            <span class="more-text" style="display: none;">${data}</span>
                            <a class="show-more">More</a>`;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'city',
                        title: 'City'
                    },
                    {
                        data: 'zip_code',
                        title: 'Zip Code'
                    },
                    {
                        data: 'first_name',
                        title: 'First Name'
                    },
                    {
                        data: 'website',
                        title: 'Website'
                    },
                    {
                        data: 'last_name',
                        title: 'Last Name'
                    },
                    {
                        data: 'designation',
                        title: 'Designation'
                    },
                    {
                        data: 'email',
                        title: 'Email'
                    },

                    {
                        data: 'email_response_1',
                        title: 'Email Response 1',
                        "width": "2px",
                        render: function(data, type, row) {
                            if (type === 'display' && data != null && data.length > 10) {
                                return `<span class="ellipsis">${data.substr(0, 10)}...</span>
                            <span class="more-text" style="display: none;">${data}</span>
                            <a class="show-more">More</a>`;
                            }
                            return data;
                        }
                    },

                    {
                        data: 'email_response_2',
                        title: 'Email Response 2',
                        "width": "2px",
                        render: function(data, type, row) {
                            if (type === 'display' && data != null && data.length > 10) {
                                return `<span class="ellipsis">${data.substr(0, 10)}...</span>
                            <span class="more-text" style="display: none;">${data}</span>
                            <a class="show-more">More</a>`;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'rating',
                        title: 'Rating'
                    },

                    {
                        data: 'followup',
                        title: 'Followup'
                    },
                    {
                        data: 'linkedin_link',
                        title: 'Linked In Link',
                        "width": "2px",
                        render: function(data, type, row) {
                            if (type === 'display' && data != null && data.length > 10) {
                                return `<span class="ellipsis">${data.substr(0, 10)}...</span>
                            <span class="more-text" style="display: none;">${data}</span>
                            <a class="show-more">More</a>`;
                            }
                            return data;
                        }
                    },

                    {
                        data: 'employee_count',
                        title: 'Employee Count'
                    },

                    {
                        mData: '',
                        render: (data, type, row) => {
                            return `
            <a class="btn btn-primary" href='user/edit/?id=${row.id}'>Edit</a>
        `;
                        }
                    }


                ],

            });



            // myTable.buttons().disable();



            // Array of specific headers you want to target
            var specificHeaders = ['Industry', 'State', 'Country', 'Client Name'];

            myTable.columns().every(function() {
                var column = this;
                var columnIndex = column.index();
                var columnHeader = $(column.header()).text().trim(); // Get the header text

                // Check if the current header matches one of the specific headers
                // if (specificHeaders.includes(columnHeader)) {
                //     var input = $('<input style="width:100px;" type="text" placeholder="Search..."/>')
                //         .appendTo($(column.header()))
                //         .on('keyup change', function() {
                //             column.search(this.value).draw();
                //             myTable.buttons().enable();
                //         });
                // }
            });


            $('#datatable').on('click', '.show-more', function() {
                var $row = $(this).closest('tr');
                var $moreText = $row.find('.more-text');
                var $ellipsis = $row.find('.ellipsis');

                $ellipsis.hide();
                $moreText.show();
                $(this).text('Less').removeClass('show-more').addClass('show-less');
            });

            $('#datatable').on('click', '.show-less', function() {
                var $row = $(this).closest('tr');
                var $moreText = $row.find('.more-text');
                var $ellipsis = $row.find('.ellipsis');

                $moreText.hide();
                $ellipsis.show();
                $(this).text('More').removeClass('show-less').addClass('show-more');
            });

            $('#search-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission behavior
                myTable.ajax.reload();
            });


            $('#searchButton').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                myTable.ajax.reload();

            });





        });
    </script>

@section('content')


    
        
                    
               
                <main class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">Conference</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:;">
                                            <i class="bi bi-grid-fill"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">All Conferences</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="ms-auto"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <div class="card">
                                <div class="card-header py-3 bg-transparent">
                                    <h5 class="mb-0">Conferences Data</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border p-3 rounded">
                                        <form class="row g-3">
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">Country</label>
                                                <select class="form-select">
                                                    <option>All</option>
                                                    <option>India</option>
                                                    <option>USA</option>
                                                    <option>UK</option>
                                                    <option>Saudi Arabia</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">Conferences</label>
                                                <select class="form-select">
                                                    <option>All</option>
                                                    <option>Neurology Disorder</option>
                                                    <option>Artificial Intellengence</option>
                                                    <option>Medical Health</option>
                                                    <option>Biosensors and Bioelectronic</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">Article</label>
                                                <select class="form-select">
                                                    <option>All</option>
                                                    <option>India</option>
                                                    <option>USA</option>
                                                    <option>UK</option>
                                                    <option>Saudi Arabia</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">User</label>
                                                <select class="form-select">
                                                    <option>All</option>
                                                    <option>Neurology Disorder</option>
                                                    <option>Artificial Intellengence</option>
                                                    <option>Medical Health</option>
                                                    <option>Biosensors and Bioelectronic</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="form-label">Created Date</label>
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
                                            <div class="col-12 col-md-4">
                                                <label class="form-label">Client Status</label>
                                                <select class="form-select">
                                                    <option>Choose One</option>
                                                    <option>Positive</option>
                                                    <option>Negative</option>
                                                    <option>Follow Up</option>
                                                    <option>Waiting For Payment</option>
                                                    <option>Rejected</option>
                                                    <option>Converted</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="form-label">Email Status</label>
                                                <select class="form-select">
                                                    <option>Choose One</option>
                                                    <option>Sent</option>
                                                    <option>Pending</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary px-4">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
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
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table align-middle">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Conference Name</th>
                                            <th>Topic</th>
                                            <th>Client Name</th>
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Email Status</th>
                                            <th>Email Sent Date</th>
                                            <th>Posted By</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                    <div class="">
                                                        <p class="mb-0">Neurology & Alzheimer’s Disease</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Label-free and ultra</td>
                                            <td>Bhargava</td>
                                            <td>gopishettybhargava@gmail.com</td>
                                            <td>India</td>
                                            <td>Sent</td>
                                            <td>2023-12-05</td>
                                            <td>Bhargava</td>
                                            <td>2023-11-23</td>
                                            <td>2023-11-24</td>
                                            <td>
                                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                    <a
                                                        href="javascript:;"
                                                        class="text-primary"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Views"
                                                    >
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Edit"
                                                    >
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Delete"
                                                    >
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                    <div class="">
                                                        <p class="mb-0">Neurology & Alzheimer’s Disease</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Label-free and ultra</td>
                                            <td>Asif</td>
                                            <td>Asif@gmail.com</td>
                                            <td>India</td>
                                            <td>Sent</td>
                                            <td>2023-12-05</td>
                                            <td>Asif</td>
                                            <td>2023-11-23</td>
                                            <td>2023-11-24</td>
                                            <td>
                                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                    <a
                                                        href="javascript:;"
                                                        class="text-primary"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Views"
                                                    >
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Edit"
                                                    >
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Delete"
                                                    >
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                    <div class="">
                                                        <p class="mb-0">Neurology & Alzheimer’s Disease</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Label-free and ultra</td>
                                            <td>Asif</td>
                                            <td>Asif@gmail.com</td>
                                            <td>India</td>
                                            <td>Sent</td>
                                            <td>2023-12-05</td>
                                            <td>Asif</td>
                                            <td>2023-11-23</td>
                                            <td>2023-11-24</td>
                                            <td>
                                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                    <a
                                                        href="javascript:;"
                                                        class="text-primary"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Views"
                                                    >
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Edit"
                                                    >
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Delete"
                                                    >
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                    <div class="">
                                                        <p class="mb-0">Neurology & Alzheimer’s Disease</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Label-free and ultra</td>
                                            <td>Asif</td>
                                            <td>Asif@gmail.com</td>
                                            <td>India</td>
                                            <td>Sent</td>
                                            <td>2023-12-05</td>
                                            <td>Asif</td>
                                            <td>2023-11-23</td>
                                            <td>2023-11-24</td>
                                            <td>
                                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                    <a
                                                        href="javascript:;"
                                                        class="text-primary"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Views"
                                                    >
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Edit"
                                                    >
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Delete"
                                                    >
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                    <div class="">
                                                        <p class="mb-0">Neurology & Alzheimer’s Disease</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Label-free and ultra</td>
                                            <td>Asif</td>
                                            <td>Asif@gmail.com</td>
                                            <td>India</td>
                                            <td>Sent</td>
                                            <td>2023-12-05</td>
                                            <td>Asif</td>
                                            <td>2023-11-23</td>
                                            <td>2023-11-24</td>
                                            <td>
                                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                    <a
                                                        href="javascript:;"
                                                        class="text-primary"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Views"
                                                    >
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Edit"
                                                    >
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Delete"
                                                    >
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                    <div class="">
                                                        <p class="mb-0">Neurology & Alzheimer’s Disease</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Label-free and ultra</td>
                                            <td>Asif</td>
                                            <td>Asif@gmail.com</td>
                                            <td>India</td>
                                            <td>Pending</td>
                                            <td>2023-12-05</td>
                                            <td>Asif</td>
                                            <td>2023-11-23</td>
                                            <td>2023-11-24</td>
                                            <td>
                                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                    <a
                                                        href="javascript:;"
                                                        class="text-primary"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Views"
                                                    >
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Edit"
                                                    >
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a
                                                        href="javascript:;"
                                                        class="text-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Delete"
                                                    >
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                class="dataTables_info fs-7 fw-bold p-4"
                                id="dtHorizontalExample_info"
                                role="status"
                                aria-live="polite"
                            >Showing 1 to 10 of 120,466 entries</div>
                            <ul class="ms-auto position-relative pagination">
                                <li class="paginate_button page-item previous disabled" id="dtHorizontalExample_previous">
                                    <a
                                        aria-controls="dtHorizontalExample"
                                        aria-disabled="true"
                                        role="link"
                                        data-dt-idx="previous"
                                        tabindex="-1"
                                        class="page-link"
                                    >Previous</a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a
                                        href="#"
                                        aria-controls="dtHorizontalExample"
                                        role="link"
                                        aria-current="page"
                                        data-dt-idx="0"
                                        tabindex="0"
                                        class="page-link"
                                    >1</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a
                                        href="#"
                                        aria-controls="dtHorizontalExample"
                                        role="link"
                                        data-dt-idx="1"
                                        tabindex="0"
                                        class="page-link"
                                    >2</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a
                                        href="#"
                                        aria-controls="dtHorizontalExample"
                                        role="link"
                                        data-dt-idx="2"
                                        tabindex="0"
                                        class="page-link"
                                    >3</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a
                                        href="#"
                                        aria-controls="dtHorizontalExample"
                                        role="link"
                                        data-dt-idx="3"
                                        tabindex="0"
                                        class="page-link"
                                    >4</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a
                                        href="#"
                                        aria-controls="dtHorizontalExample"
                                        role="link"
                                        data-dt-idx="4"
                                        tabindex="0"
                                        class="page-link"
                                    >5</a>
                                </li>
                                <li class="paginate_button page-item disabled" id="dtHorizontalExample_ellipsis">
                                    <a
                                        aria-controls="dtHorizontalExample"
                                        aria-disabled="true"
                                        role="link"
                                        data-dt-idx="ellipsis"
                                        tabindex="-1"
                                        class="page-link"
                                    >…</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a
                                        href="#"
                                        aria-controls="dtHorizontalExample"
                                        role="link"
                                        data-dt-idx="12046"
                                        tabindex="0"
                                        class="page-link"
                                    >12047</a>
                                </li>
                                <li class="paginate_button page-item next" id="dtHorizontalExample_next">
                                    <a
                                        href="#"
                                        aria-controls="dtHorizontalExample"
                                        role="link"
                                        data-dt-idx="next"
                                        tabindex="0"
                                        class="page-link"
                                    >Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </main>
              
            @endsection