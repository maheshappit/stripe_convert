@extends('layouts.admindashboard')

@section('content')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <link href="assets/plugins/datetimepicker/css/classic.css" rel="stylesheet">
    <link href="assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet">
    <link href="assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet">
    <!--Theme Styles-->
    <link href="assets/css/dark-theme.css" rel="stylesheet">
    <link href="assets/css/light-theme.css" rel="stylesheet">
    <link href="assets/css/semi-dark.css" rel="stylesheet">
    <link href="assets/css/header-colors.css" rel="stylesheet">


    <title>Stripe Conferences</title>
</head>

<style>
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

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        width: 600px;
        top: 100px !important;
    }
</style>


<script>
    $(document).ready(function() {
        // Set default selected value
        //   var defaultCountry = 'all';

        // Set the default value in the dropdown
        var my = $('#country').val();

        if (typeof my !== 'undefined') {

            var my = $('#country').val();

            $('#country').change();


            var url = "{{ route('all-conferences', ['id' => 'id']) }}";
            url = url.replace('id', my);

            // Make an AJAX request to retrieve conference names based on the selected country
            $.ajax({
                url: url, // Replace with your server-side script
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the conference list with the retrieved data
                    $('#conference').html(displayconferenceNames(data.conferenceNames));
                },
                error: function(error) {
                    console.error('Error fetching conference names:', error);
                }
            });

            $('#country').change(function() {
                // Get the selected country value
                var selectedCountry = $(this).val();

                var url = "{{ route('all-conferences', ['id' => 'id']) }}";
                url = url.replace('id', selectedCountry);

                // Make an AJAX request to retrieve conference names based on the selected country
                $.ajax({
                    url: url, // Replace with your server-side script
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Update the conference list with the retrieved data
                        $('#conference').html(displayconferenceNames(data.conferenceNames));
                    },
                    error: function(error) {
                        console.error('Error fetching conference names:', error);
                    }
                });
            });




            function displayconferenceNames(conferenceNames) {
                var html = '<select id="conference" class="conference"> <option>All</option>';

                $.each(conferenceNames, function(index, conferenceName) {
                    html += '<option>' + conferenceName + '</option>';
                });
                html += '</select>';
                return html;
            }

        } else {

            // Listen for changes in the country dropdown
            $('#country').change(function() {
                // Get the selected country value
                var selectedCountry = $(this).val();

                var url = "{{ route('all-conferences', ['id' => 'id']) }}";
                url = url.replace('id', selectedCountry);

                // Make an AJAX request to retrieve conference names based on the selected country
                $.ajax({
                    url: url, // Replace with your server-side script
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Update the conference list with the retrieved data
                        $('#conference').html(displayconferenceNames(data.clientNames));
                    },
                    error: function(error) {
                        console.error('Error fetching conference names:', error);
                    }
                });
            });

            function displayconferenceNames(conferenceNames) {
                var html = '<select id="conference" class="conference">';

                $.each(conferenceNames, function(index, conferenceName) {
                    html += '<option>' + conferenceName + '</option>';
                });
                html += '</select>';
                return html;
            }

        }

        // Trigger the change event to make the AJAX request


    });


    $(document).ready(function() {
        $('#conference').on('change', function() {



            var selectedCountryId = $(this).val();
            var selectedCountryName = $(this).find('option:selected').text();




            if (selectedCountryId !== 'all_countries') {
                // Generate the URL using the Laravel route helper
                var url = "{{ route('all-articles', ['id' => 'id']) }}";
                url = url.replace('id', selectedCountryName);

                // Make an AJAX request to the generated URL
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json', // Expect JSON response
                    success: function(data) {

                        // Update the result div with the received client names
                        $('#article').html(displayClientNames(data.topicNames));
                    },
                    error: function(error) {
                        // Handle errors if necessary
                        console.log(error);
                    }
                });
            } else {
                // Handle the case when 'All' is selected
                $('#article').html('');
            }
        });

        function displayClientNames(topicNames) {
            var html = '<h2>Client Names:</h2><select><option value="All">All</option>';
            $.each(topicNames, function(index, clientName) {
                html += '<option>' + clientName + '</option>';
            });
            html += '</select>';
            return html;
        }
    });
</script>


<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Attach a click event handler to the search button
        $("#ClearBtn").click(function(e) {
            e.preventDefault();
            var inputData = $('#search').val();
            $('#search').val('');

        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#toggleCheckbox").change(function() {
            if (this.checked) {
                $("#hiddenButton").show();
            } else {
                $("#hiddenButton").hide();
            }
        });
    });
</script>

<script>
    $(function() {
        // Define the callback function
        function updateDateRange(start, end) {
            var startDateInput = document.getElementById('from_date');
            startDateInput.value = '';

            var desiredStartDate = new Date(start.format('YYYY-MM-DD'));
            var formattedStartDate = desiredStartDate.toISOString().split('T')[0];
            startDateInput.value = formattedStartDate;

            var endDateInput = document.getElementById('to_date');
            var desiredEndDate = new Date(end.format('YYYY-MM-DD'));
            var formattedEndDate = desiredEndDate.toISOString().split('T')[0];
            endDateInput.value = formattedEndDate;

            $('#reportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        // Initialize with no default selection
        $('#reportrange2').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, updateDateRange);

        // Event listener for the 'apply.daterangepicker' event
        $('#reportrange2').on('apply.daterangepicker', function(ev, picker) {
            // Check if the date range has changed

            // Retrieve the selected dates
            var fromDate = picker.startDate.format('YYYY-MM-DD');
            var toDate = picker.endDate.format('YYYY-MM-DD');

            // Update the value of the element with id 'email_sent_from_date' and 'email_sent_to_date'
            $('#from_date').val(fromDate);
            $('#to_date').val(toDate);

            // Update the date range display
            $('#reportrange2 span').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
        });
    });
</script>

<script>
    $(function() {
        // Define the callback function
        function cb(start, end) {
            var start_date = document.getElementById('email_sent_from_date');
            start_date.value = '';

            var desiredStartDate = new Date(start.format('YYYY-MM-DD'));
            var formattedStartDate = desiredStartDate.toISOString().split('T')[0];
            start_date.value = formattedStartDate;

            var end_date = document.getElementById('email_sent_to_date');
            var desiredEndDate = new Date(end.format('YYYY-MM-DD'));
            var formattedEndDate = desiredEndDate.toISOString().split('T')[0];
            end_date.value = formattedEndDate;

            $('#reportrange3 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        // Initialize with no default selection
        $('#reportrange3').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        // Event listener for the 'apply.daterangepicker' event
        $('#reportrange3').on('apply.daterangepicker', function(ev, picker) {
            // Check if the date range has changed

            // Retrieve the selected dates
            var from_date = picker.startDate.format('YYYY-MM-DD');
            var to_date = picker.endDate.format('YYYY-MM-DD');

            // Update the value of the element with id 'email_sent_from_date' and 'email_sent_to_date'
            $('#email_sent_from_date').val(from_date);
            $('#email_sent_to_date').val(to_date);

            // Update the date range display
            $('#reportrange3 span').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
        });
    });
</script>


<script>
    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = 'none';
    }


    function sendDataToModel(id) {




        $.ajax({
            url: `{{ route('user.get.iddata', ['id' => '']) }}${id}`,
            method: 'GET',
            dataType: 'json',
            success: function(response, status, xhr) {
                if (xhr.status === 200) {
                    // Update the value of the 'name' element

                    $('#id').val(response.user.id);

                    $('#role').val(response.user.role);

                    $('#name').val(response.user.name);
                    $('#email').val(response.user.email);


                    // Open the modal
                    $('#myModal').modal('show');
                } else {
                    console.error('Request succeeded, but with unexpected status code:', xhr.status);
                }



            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed with status:', status, 'and error:', error);
            }
        });
    }

    function sendDataToModelDeleteModal(id) {





        $.ajax({
            url: `{{ route('user.get.iddata', ['id' => '']) }}${id}`,
            method: 'GET',
            dataType: 'json',
            success: function(response, status, xhr) {

                $('#DeleteModal').modal('show');



                if (xhr.status === 200) {
                    // Update the value of the 'name' element

                    $('#id').val(response.user.id);

                    $('#role').val(response.user.role);

                    $('#name').val(response.user.name);
                    $('#email').val(response.user.email);


                    // Open the modal
                } else {
                    console.error('Request succeeded, but with unexpected status code:', xhr.status);
                }



            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed with status:', status, 'and error:', error);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {

        $('#myForm').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();



            $.ajax({
                type: 'POST',
                url: '{{ route('admin.normaluser.update') }}',

                data: formData,
                success: function(response) {


                    if (response.status_code == 200) {
                        toastr.success(response.message);
                        $('#name').val('');
                        $('#email').val('');
                        $('#role').val('');
                        $('#id').val('');
                        $('#myModal').modal('hide');

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
        var myTable; // Declare a variable to store the DataTable object


        myTable = $('#dtHorizontalExample').DataTable({
            "scrollX": true,







            "columnDefs": [{
                "targets": [3], // Assuming "Street" is the second column (index 1)
                "render": function(data, type, row) {
                    if (type === 'display' && data != null && data.length > 20) {
                        return `<span class="ellipsis">${data.substr(0, 20)}...</span>
                            <span class="more-text" style="display: none;">${data}</span>
                            <a href="" onclick="return false;" class="show-more">More</a>`;
                    }
                    return data;
                }
            }],


            dom: 'lBfrtip',
            buttons: [
                'excel',
                'selectNone'
            ],

            // 'responsive': true,

            processing: true,
            serverSide: true,
            autoWidth: false,
            recordsTotal: 50,
            ajax: {
                url: "{{ route('admin.get.allusers') }}",
                data: function(d) {

                    d.db = $('#db').val();
                    d.search = $('#search').val();
                    d.conference = $('#conference').val();
                    d.country = $('#country').val();
                    d.article = $('#article').val();
                    d.user = $('#user').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d.email_sent_from_date = $('#email_sent_from_date').val();
                    d.email_sent_to_date = $('#email_sent_to_date').val();

                    d.email_status = $('#email_status').val();





                    var conference_id = $('#conference').val();

                    var county_id = $('#country').val();

                    var dba = $('#db').val();

                    var search = d.search = $('#search').val();


                    console.log(search);


                }
            },

            columns: [


                {
                    title: 'S.no',
                    data: 'id',
                    "render": function(data, type, row, meta) {
                        // 'meta.row' is the row index, 'meta.settings._iDisplayStart' is the page start index
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    title: 'Name',
                    data: 'name'

                },

                {
                    title: 'Email',
                    data: 'email'
                },

                {
                    title: 'Role',
                    data: 'role'

                },















                {
                    title: 'Action',

                    mData: '',
                    render: (data, type, row) => {
                        return `
                        <button class="btn-sm btn-primary editBtn" data-id="${row.id}" onclick="sendDataToModel(${row.id})">Edit</button>



            <tr>

            <button class="btn-sm btn-danger " data-id="${row.id}" onclick="sendDataToModelDeleteModal(${row.id})">Delete</button>


        `;
                    },





                },


            ],

        });

        $('.dt-button.buttons-excel.buttons-html5').on('click', function() {
            // Trigger the Excel export

            $("#loader").show();


            var columnNameToSearch = 'Email';

            var columnIndex = myTable.column(':contains(' + columnNameToSearch + ')').index();
            console.log(columnIndex);

            var allData = myTable.rows().data().toArray();

            var emails = allData.map(function(row) {
                return row['email'];
            });


            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{route('download.email')}}',
                method: 'POST', // or 'GET' depending on your smoreerver-side implementation
                data: {
                    _token: csrfToken, // Include the CSRF token in your data
                    emails: emails
                },
                success: function(response) {
                    // Handle the success response
                    console.log(response);
                },
                error: function(error) {
                    // Handle the error
                    console.error(error);
                }
            });



        });



        // myTable.buttons().disable();



        // Array of specific headers you want to target
        var specificHeaders = ['Industry', 'State', 'Country', 'conference Name'];

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


        $('#dtHorizontalExample').on('click', '.show-more', function() {
            var $row = $(this).closest('tr');
            var $moreText = $row.find('.more-text');
            var $ellipsis = $row.find('.ellipsis');

            $ellipsis.hide();
            $moreText.show();
            $(this).text('Less').removeClass('show-more').addClass('show-less');
        });

        $('#dtHorizontalExample').on('click', '.show-less', function() {
            var $row = $(this).closest('tr');
            var $moreText = $row.find('.more-text');
            var $ellipsis = $row.find('.ellipsis');

            $moreText.hide();
            $ellipsis.show();
            $(this).text('More').removeClass('show-less').addClass('show-more');
        });



        $('#myTable').on('length.dt', function(e, settings, len) {
            // Log the selected number of entries to the console
            console.log('Show entries changed to:', len);
        });

        //         $('#toggleCheckbox').on('change', function() {


        //             var tr = $(this).closest('tr');
        //         var isSelected = this.checked;

        //         // Toggle the selected class on the row
        //         tr.toggleClass('selected', isSelected);
        //             myTable.rows().nodes().to$().find('.checkbox').prop('checked', isSelected);

        // // Toggle the selected class on all rows
        // myTable.rows().nodes().to$().toggleClass('selected', isSelected);


        //     });

        // $('#dtHorizontalExample tbody').on('change', '.checkbox', function() {
        //     // Uncheck "Select All" if any individual checkbox is unchecked
        //     var tr = $(this).closest('tr');
        //     var isSelected = this.checked;

        //     // Toggle the selected class on the row
        //     tr.toggleClass('selected', isSelected);

        //     $("#hiddenButton").show();



        // });










    });
</script>

<script>
    function closeModal() {
        $('#myModal').modal('hide');

    }



    function closeDeleteModel() {
        $('#DeleteModal').modal('hide');

    }


    function openDeleteModal() {
        $('#deleteModal').modal('show');
    }



    function confirmDelete() {
        const id = document.getElementById('id').value;

        $.ajax({
            url: `{{ route('admin.normaluser.delete', ['id' => '']) }}${id}`,
            method: 'GET',
            dataType: 'json',
            success: function(response, status, xhr) {

                if (xhr.status === 200) {

                    toastr.success(response.message);
                    $('#DeleteModal').modal('hide');

                    setTimeout(function() {
                        window.location.href = '{{ route('admin.show.allusers') }}';
                    }, 2000);


                } else {
                    console.error('Request succeeded, but with unexpected status code:', xhr.status);
                }



            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed with status:', status, 'and error:', error);
            }
        });
    }

    function closeDeleteModal() {
        $('#deleteModal').modal('hide');
    }
</script>


<div class="wrapper">
    <!--start top header-->


    <main class="page-content">
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
                        <li class="breadcrumb-item active" aria-current="page">All Users</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto"></div>
        </div>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0"> All Users Data</h5>
                    </div>
                    <div>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <!-- <div class="d-flex align-items-center mb-3">
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




                        <table id="dtHorizontalExample">

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">User Update</h5>
                                            <button type="button" class="close" onclick="closeModal('modal1')" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Content goes here -->
                                            <form id="myForm">
                                                @csrf

                                                <input type="text" id="id" name="id" class="form-control" hidden>

                                                <label for="name">Name:</label>
                                                <input type="text" id="name" name="name" class="form-control">


                                                <label for="name">Email:</label>
                                                <input type="text" id="email" name="email" class="form-control">

                                                <input type="text" id="role" name="role" class="form-control" hidden>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>

                                            <button type="button" class="btn btn-secondary" onclick="closeModal('modal1')" data-dismiss="modal">Close</button>

                                            <!-- Additional buttons or actions if needed -->
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>




                            <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <input type="text" hidden id="id" name="id">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                            <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModel()" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this user?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Confirm Delete</button>
                                            <button type="button" class="btn btn-secondary" onclick="closeDeleteModel()" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- <table id="dtHorizontalExample" class="table table-striped table-bordered border-primary" style="width:100%">
                    <thead class="table-primary">
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
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
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
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
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
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
                    </div>

                </div>
            </div>
        </div>

    </main>
    <a href="javaScript:;" class="back-to-top">
        <i class="bx bxs-up-arrow-alt"></i>
    </a>
</div>
<!-- <script>
    new DataTable('#example');
</script> -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<!-- <script src="assets/js/jquery.min.js"></script> -->
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/js/pace.min.js"></script>
<script src="assets/plugins/datetimepicker/js/legacy.js"></script>
<script src="assets/plugins/datetimepicker/js/picker.js"></script>
<script src="assets/plugins/datetimepicker/js/picker.time.js"></script>
<script src="assets/plugins/datetimepicker/js/picker.date.js"></script>
<script src="assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
<script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
<script src="assets/js/form-date-time-pickes.js"></script>
<!--app-->
<script src="assets/js/app.js"></script>
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

@endsection