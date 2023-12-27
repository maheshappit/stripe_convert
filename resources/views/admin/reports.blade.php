@extends('layouts.admindashboard')

@section('dashboard-content')

<head>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .error-message {
            margin-left: 5rem;
            color: red;
        }

        #reportrange {
            width: fit-content !important;

        }
    </style>

</head>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


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

            $('#from_date').val('');
            $('#to_date').val('');


        })

        // Intercept the form submission
        $('#form').submit(function(e) {
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
            const from_date = formatDate(f_date);
            const to_date = formatDate(t_date);

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
                            from_date + ' To ' + to_date,
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
                        $('#error-from_date').text('');
                        $('#error-to_date').text('');



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
                // Assuming you have elements with IDs like 'error-from_date' and 'error-to_date'
                $('#' + 'error-' + key).html('<p class="error-message">' + value[0] + '</p>');
            });
        }
    });
</script>

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






<div class="item">
    <h6>Reports</h6>
    <div></div>

    <form id="form">

        @csrf

        <div class="form-row">


            <div>
                <label for="user_id"> Users:</label>
                <select id="user_id" name="user_id" class="user_id" style="height: 30;">
                    <option value="All">All</option>
                    @foreach($all_users as $name)
                    <option value="{{ $name['id'] }}">{{ $name['name'] }}</option>
                    @endforeach
                </select>

            </div>




            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>



            <div>
                <label for="user_id"> By Conference Name:</label>
                <select id="conference" name="conference" class="conference" style="height: 30;">
                    <option value="All">All</option>
                    @foreach($all_conferences as $name)
                    <option value="{{ $name}}">{{ $name }}</option>
                    @endforeach
                </select>

            </div>


            <!-- <div>
                <label for="user_id"> Email Status:</label>
                <select class="custom-select" id="email_status" name="email_status">
                    <option value="pending">Pending</option>
                    <option value="sent">Sent</option>
                </select>
            </div>


            <div>
                <label for="user_id"> Client Status:</label>
                <select class="custom-select"  name="client_status_id">
                    @foreach ($clientStatuses as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div> -->



            <div>
                <input type="date" id="start_date" hidden name="start_date" />
                <input type="date" id="end_date" hidden name="end_date" />

            </div>
            <div>
                <button class="btn btn-primary" type="submit">Submit</button>
                <button id="clear" class="btn btn-warning">clear</button>

            </div>


        </div>



    </form>


    <div>
    </div>
</div>

<div class="item">
    <table class="table">
        <thead>

            <tr>
                <th>Total Users Count</th>
                <th>Total Inserted Count:</th>
                <th>Toal Updated Count:</th>
                <th>Total Downloaded Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="usersCount">{{$users_count ?? ''}}</td>
                <td id="inserted_count">{{$inserted_count ?? ''}}</td>
                <td id="updated_count">{{$updated_count ?? ''}}</td>
                <td id="downloaded_count">{{$download_count ?? ''}}</td>

            </tr>

        </tbody>
    </table>

</div>

<div class="item">
    <table id="dataTable" class="table table-striped">
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
@endsection