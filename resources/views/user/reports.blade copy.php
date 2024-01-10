@extends('layouts.dashboard_header')

@section('content')

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

        #reportrange2 {
            width: fit-content !important;

        }
    </style>

</head>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {

            var start_date = document.getElementById('from_date');
            var desiredStartDate = new Date(start.format('YYYY-MM-DD'));
            var formattedStartDate = desiredStartDate.toISOString().split('T')[0];
            start_date.value = formattedStartDate;
            start_date.innerHTML = start.format('YYYY-MM-DD');


            var end_date = document.getElementById('to_date');
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

<script>
    $(document).ready(function() {
        // Initialize DataTable with buttons
        var table = $('#dataTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'excel'
            ],
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

            var f_date = $('#from_date').val();

            var t_date = $('#to_date').val();



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

            console.log(to_date);




            // Get form data
            var formData = $(this).serializeArray();

            // Add additional variable to the payload

            // Make an Ajax request
            $.ajax({
                type: 'POST',
                url: "{{ route('report.download') }}", // Use the route function to generate the URL
                data: formData,
                success: function(response, status) {


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
                            from_date + ' To ' + to_date,
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



            <label for=""> Date Range:</label>

            <div id="reportrange2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>


            <div>
                <input type="date" id="from_date" hidden name="from_date" />
                <input type="date" id="to_date" hidden name="to_date" />

            </div>


            <!-- <div>
                <label for="country">From Date:</label>
                <input type="date" id="from_date" name="from_date" >
                <p class="message" id="error-from_date"></p>


            </div> -->

            <!-- <div>
                <label for="country">To Date:</label>
                <input type="date" id="to_date" name="to_date">
                <p class="message" id="error-to_date"></p>

            </div> -->

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
                <th>Toal Users Count</th>
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
                <td id="downloaded_count">{{$downloaded_count ?? ''}}</td>

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
                <th>Inserted Count</th>
                <th>Updated Count</th>
                <th>Downloaded Count</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body will be populated using Ajax response -->
        </tbody>
    </table>
</div>
@endsection