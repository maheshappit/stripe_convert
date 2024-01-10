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


<script>
    $(document).ready(function() {
        // Set default selected value
        //   var defaultCountry = 'all';

        // Set the default value in the dropdown
        var my = $('#country').val();

        if (typeof my !== 'undefined') {

            var my = $('#country').val();

            $('#country').change();


            var url = "{{ route('admin.all.conferences', ['id' => 'id']) }}";
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
        function resetSelect() {
            alert();
            // Get the select element by its id
            var selectElement = document.getElementById('country');

            // Set the selectedIndex to 0 to reset to the first option
            selectElement.val().reset();
        }



        function openViewModal() {
            var viewmodal = document.getElementById('ViewCommentsModal');
            viewmodal.style.display = 'block';
        }

        function closeViewModal() {
            var viewmodal = document.getElementById('ViewCommentsModal');
            viewmodal.style.display = 'none';
        }


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

        function makeAjaxCall(conference,article,email) {
    const url = `comments?conference=${conference}&article=${article}&email=${email}`;

        // Make an AJAX request to fetch comments
        fetch(url)  // Update the URL to your actual API endpoint
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
    $(document).ready(function() {
        var myTable; // Declare a variable to store the DataTable object


        myTable = $('#adminConferencesTable').DataTable({
            "scrollX": true,


            "select": {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]'
            },





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
                url: "{{ route('admin.users') }}",
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
                    d.client_status = $('#client_status').val();






                    var conference_id = $('#conference').val();

                    var county_id = $('#country').val();

                    var dba = $('#db').val();

                    var search = d.search = $('#search').val();


                    console.log(search);


                }
            },

            columns: [
                    {
                        title: '', // Empty title for the checkbox column
                        data: null,
                        orderable: false,
                        searchable: false,
                        defaultContent: '<input type="checkbox" class="checkbox"/>'
                    },
                    {
                        title: 'S.no',
                        data: 'id',
                        "render": function(data, type, row, meta) {
                            // 'meta.row' is the row index, 'meta.settings._iDisplayStart' is the page start index
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        title: 'Conference Name',
                        data: 'conference'

                    },

                    {
                        title: 'Topic',
                        data: 'article'
                    },

                    {
                        title: 'Client Name',
                        data: 'name'

                    },

                    {
                        title: 'Client Status',
                        data: 'client_status'

                    },
                    {
                        title: 'Email',
                        data: 'email'

                    },

                    {
                        title: 'Country',
                        data: 'country'

                    },


                    {
                        title: 'Email Status',
                        data: 'email_sent_status'

                    },



                    {
                        title: 'Email Sent Date',
                        data: 'email_sent_date'

                    },




                    {
                        title: 'Posted By',
                        data: 'posted_by'

                    },
                    {
                        title: 'Created Date',
                        data: 'user_created_at'

                    },
                    {
                        title: 'Updated Date',
                        data: 'user_updated_at'
                    },





                    {
                        title: 'Action',

                        mData: '',
                        render: (data, type, row) => {
                            return `
            <a  class="custom-button" href='{{ route('admin.user.edit') }}/?id=${row.id}'>Edit</a>
        `;
                        },



                    },
                    {
                        mData: '',
                        render: (data, type, row) => {
                            if (row.comments_count >= 1) {
                                const conference = row.conference;
                                const article = row.article;
                                const email = row.email;
                                return `<button class="custom-button" onclick="makeAjaxCall('${conference}', '${article}', '${email}')">View Incidents</button>`;
                            } else {
                                // Optionally, you can provide an alternative content or an empty string if you don't want to show anything.
                                return '';
                            }
                        }
                    }
                    
                    

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


        $('#adminConferencesTable').on('click', '.show-more', function() {
            var $row = $(this).closest('tr');
            var $moreText = $row.find('.more-text');
            var $ellipsis = $row.find('.ellipsis');

            $ellipsis.hide();
            $moreText.show();
            $(this).text('Less').removeClass('show-more').addClass('show-less');
        });

        $('#adminConferencesTable').on('click', '.show-less', function() {
            var $row = $(this).closest('tr');
            var $moreText = $row.find('.more-text');
            var $ellipsis = $row.find('.ellipsis');

            $moreText.hide();
            $ellipsis.show();
            $(this).text('More').removeClass('show-less').addClass('show-more');
        });

        $('#search-btn').on('click', function(e) {

            var selectedCountryId = $('#conference').val();


            if (selectedCountryId === 'All') {
                $('#toggleCheckbox').prop('disabled', true);

                $("#hiddenButton").hide();

            } else {
                $('#toggleCheckbox').prop('disabled', false);

            }

            console.log(name);

            e.preventDefault(); // Prevent the default form submission behavior
            myTable.ajax.reload();
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

        // $('#adminConferencesTable tbody').on('change', '.checkbox', function() {
        //     // Uncheck "Select All" if any individual checkbox is unchecked
        //     var tr = $(this).closest('tr');
        //     var isSelected = this.checked;

        //     // Toggle the selected class on the row
        //     tr.toggleClass('selected', isSelected);

        //     $("#hiddenButton").show();



        // });


        // Event listener for checkbox change
        $('#adminConferencesTable tbody').on('change', '.checkbox', function() {
            var tr = $(this).closest('tr');
            var isSelected = this.checked;

            // Toggle the selected class on the row
            tr.toggleClass('selected', isSelected);

            // If "Select All" checkbox is clicked
            if ($(this).hasClass('select-all')) {
                // Update all checkboxes in the table
                myTable.rows().nodes().to$().find('.checkbox').prop('checked', isSelected);

                // Toggle the selected class on all rows
                myTable.rows().nodes().to$().toggleClass('selected', isSelected);
            } else {
                // Check the "Select All" checkbox if all checkboxes are checked
                var allCheckboxes = myTable.rows().nodes().to$().find('.checkbox');
                var allChecked = allCheckboxes.length === allCheckboxes.filter(':checked').length;
                myTable.rows().nodes().to$().find('.select-all').prop('checked', allChecked);
            }

            // Get the updated selected rows' data
            var selectedData = myTable.rows('.selected').data().toArray();
        });

        // Event listener for "Select All" checkbox change
        $('#toggleCheckbox').on('change', function() {
            var isSelected = this.checked;

            // Update all checkboxes in the table
            myTable.rows().nodes().to$().find('.checkbox').prop('checked', isSelected);

            // Toggle the selected class on all rows
            myTable.rows().nodes().to$().toggleClass('selected', isSelected);
        });




        $('#searchButton').on('click', function(e) {
            e.preventDefault(); // Prevent the default form submission behavior

            myTable.ajax.reload();



        });

        $('#hiddenButton').on('click', function() {



            var selectedData = myTable.rows('.selected').data().toArray();






            // Now, filter the selectedData based on the checkbox status
            console.log(selectedData);

            var conference_id = $('#conference').val();

            var routeUrl = "{{ route('user.sent.emails') }}"; // Replace 'your.route' with the actual route name

            var csrfToken = $('meta[name="csrf-token"]').attr('content');


            var selectedData = myTable.rows('.selected').data().toArray();


            $.ajax({
                type: 'POST',
                url: routeUrl,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    selectedData: selectedData,
                    conference: conference_id,


                },
                success: function(response, status, xhr) {
                    // Handle the response from the controller if needed


                    // Create a Blob from the response
                    var blob = new Blob([response], {
                        type: 'text/csv'
                    });

                    // Create a link to download the file
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'downloaded_data.csv';

                    // Append the link to the body and trigger the download
                    document.body.appendChild(link);
                    link.click();

                    // Remove the link from the body
                    document.body.removeChild(link);



                    var statusMessage = xhr.getResponseHeader('X-Status-Message');
                    toastr.success(statusMessage);

                    $("#toggleCheckbox").prop("checked", false);


                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error('Error downloading CSV file:', error);
                }
            });
        });





    });
</script>


<div class="wrapper">
    <!--start top header-->


    <main class="page-content">
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


                                    <select id="country" name="country" class="country form-select">
                                        <option value="All">All</option>
                                        @foreach($countries as $code => $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Conferences</label>
                                    <select id="conference" name="conference" class="conference form-select" style="width:auto">

                                        <option value="All">All conference Names</option>

                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Article</label>

                                    <select id="article" name="article" class="article form-select" style="width:auto">

                                        <option value="All">All Article Names</option>

                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">User</label>
                                    <select id="user" name="user" class="user form-select">
                                        <option value="All">All</option>
                                        @foreach($users as $code => $name)
                                        <option value="{{ $name['id'] }}">{{ $name['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Created Date</label>
                                    <div id="reportrange2" style="
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

                                    <div>
                                        <input type="date" id="from_date" hidden name="from_date" />
                                        <input type="date" id="to_date" hidden name="to_date" />

                                    </div>


                                </div>


                                <div class="col-12 col-md-4">
                                    <label class="form-label">Email Set Date</label>
                                    <div id="reportrange3" style="
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
                                    <div>
                                        <input type="date" id="email_sent_from_date" hidden name="email_sent_from_date" />
                                        <input type="date" id="email_sent_to_date" hidden name="email_sent_to_date" />

                                    </div>

                                </div>
                                <!-- <div class="col-12 col-md-4">
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
                                </div> -->
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Email Status</label>
                                    <select class="form-select" name="email_status" id="email_status">
                                        <option value="All">All</option>
                                        <option value="sent">Sent</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label">Client Status</label>
                                    <select id="client_status" name="client_status" class="client_status form-select">
                                        <option value="All">All</option>
                                        @foreach($conferences as $code => $name)
                                        <option value="{{ $name->id}}">{{ $name->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button id="search-btn" class="btn btn-primary px-4">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- <div class="d-flex align-items-center mb-3">
                    <label>
                        Show Enteries
                        <select name="adminConferencesTable_length" aria-controls="adminConferencesTable" class="form-select form-select-sm">
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

                <input type="checkbox" id="toggleCheckbox" class="select-all" disabled> Select All
                <button id="hiddenButton" class="btn btn-success" style="display: none;">Sent Email</button>
                <table id="adminConferencesTable">

                    <!-- <table id="adminConferencesTable" class="table table-striped table-bordered border-primary" style="width:100%">
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
            <!-- <div class="d-flex align-items-center">
                <div class="dataTables_info fs-7 fw-bold p-4" id="adminConferencesTable_info" role="status" aria-live="polite">Showing 1 to 10 of 120,466 entries</div>
                <ul class="ms-auto position-relative pagination">
                    <li class="paginate_button page-item previous disabled" id="adminConferencesTable_previous">
                        <a aria-controls="adminConferencesTable" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a>
                    </li>
                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="adminConferencesTable" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="adminConferencesTable" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="adminConferencesTable" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="adminConferencesTable" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="adminConferencesTable" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a>
                    </li>
                    <li class="paginate_button page-item disabled" id="adminConferencesTable_ellipsis">
                        <a aria-controls="adminConferencesTable" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="adminConferencesTable" role="link" data-dt-idx="12046" tabindex="0" class="page-link">12047</a>
                    </li>
                    <li class="paginate_button page-item next" id="adminConferencesTable_next">
                        <a href="#" aria-controls="adminConferencesTable" role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a>
                    </li>
                </ul>
            </div> -->
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