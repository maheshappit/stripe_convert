@extends('layouts.dashboard')

@section('dashboard-content')


<script>
    $(document).ready(function() {
        $("#toggleCheckbox").change(function() {
            if (this.checked) {
                $("#hiddenButtonMoveData").show();
            } else {
                $("#hiddenButtonMoveData").hide();
            }
        });
    });
</script>

<head>

    <style>
        .hidden {
            display: none;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.country').select2();
            $('.conference').select2();
            $('.article').select2();
            $('.email_status').select2();




        });
    </script>








</head>

<script>
    $(document).ready(function() {
        var myTable; // Declare a variable to store the DataTable object


        myTable = $('#dtHorizontalExample2').DataTable({
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
                url: "{{ route('admin.all.todaydata') }}",
                data: function(d) {

                    d.db = $('#db').val();
                    d.search = $('#search').val();
                    d.conference = $('#conference').val();
                    d.country = $('#country').val();
                    d.article = $('#article').val();
                    d.user = $('#user').val();
                    d.user_created_at = $('#user_created_at').val();
                    d.user_updated_at = $('#user_updated_at').val();
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
            <a  class="custom-button" href='{{ route('user.edit') }}/?id=${row.id}'>Edit</a>
        `;
                    },



                },


            ],

        });

        // $('.btn.btn-secondary.buttons-excel.buttons-html5').on('click', function() {
        //     // Trigger the Excel export

        //     $("#loader").show();


        //     var columnNameToSearch = 'Email';

        //     var columnIndex = myTable.column(':contains(' + columnNameToSearch + ')').index();
        //     console.log(columnIndex);

        //     var allData = myTable.rows().data().toArray();

        //     var emails = allData.map(function(row) {
        //         return row['email'];
        //     });


        //     var csrfToken = $('meta[name="csrf-token"]').attr('content');

        //     $.ajax({
        //         url: '{{route('download.email')}}',
        //         method: 'POST', // or 'GET' depending on your smoreerver-side implementation
        //         data: {
        //             _token: csrfToken, // Include the CSRF token in your data
        //             emails: emails
        //         },
        //         success: function(response) {
        //             // Handle the success response
        //             console.log(response);
        //         },
        //         error: function(error) {
        //             // Handle the error
        //             console.error(error);
        //         }
        //     });



        // });



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


        $('#dtHorizontalExample2').on('click', '.show-more', function() {
            var $row = $(this).closest('tr');
            var $moreText = $row.find('.more-text');
            var $ellipsis = $row.find('.ellipsis');

            $ellipsis.hide();
            $moreText.show();
            $(this).text('Less').removeClass('show-more').addClass('show-less');
        });

        $('#dtHorizontalExample2').on('click', '.show-less', function() {
            var $row = $(this).closest('tr');
            var $moreText = $row.find('.more-text');
            var $ellipsis = $row.find('.ellipsis');

            $moreText.hide();
            $ellipsis.show();
            $(this).text('More').removeClass('show-less').addClass('show-more');
        });

        $('#search-btn').on('click', function(e) {

            var selectedCountryId = $('#conference').val();


            // if (selectedCountryId === 'All') {
            //     $('#toggleCheckbox').prop('disabled', true);

            //     $("#hiddenButtonMoveData").hide();

            // } else {
            //     $('#toggleCheckbox').prop('disabled', false);

            // }

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

        // $('#dtHorizontalExample2 tbody').on('change', '.checkbox', function() {
        //     // Uncheck "Select All" if any individual checkbox is unchecked
        //     var tr = $(this).closest('tr');
        //     var isSelected = this.checked;

        //     // Toggle the selected class on the row
        //     tr.toggleClass('selected', isSelected);

        //     $("#hiddenButtonMoveData").show();



        // });


        // Event listener for checkbox change
        $('#dtHorizontalExample2 tbody').on('change', '.checkbox', function() {
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

        $('#hiddenButtonMoveData').on('click', function() {



            var selectedData = myTable.rows('.selected').data().toArray();






            // Now, filter the selectedData based on the checkbox status
            console.log(selectedData);

            var conference_id = $('#conference').val();

            var routeUrl = "{{ route('admin.update.conferencedata') }}"; // Replace 'your.route' with the actual route name

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
                    console.log(response);
                    toastr.success("Data Moved Successfully");





                    $("#toggleCheckbox").prop("checked", false);


                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message;
                    alert('Error: ' + errorMessage);
                }
            });
        });





    });
</script>


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- <div class="item">
    <div class="input-group mb-3">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search Data Here..." aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-success" id="searchButton" type="button">Search</button>
            <button class="btn btn-warning" id="MainClearBtn" type="button">Clear</button>
        </div>
    </div>

</div> -->





<div class="item">

    <h6>Recent Conferences Data</h6>
    <form id="form">

        <div class="form-row">





            <div>
                <label for="user"> Users:</label>
                <select id="user" name="user" class="user">
                    <option value="All">All</option>
                    @foreach($users as $code => $name)
                    <option value="{{ $name['id'] }}">{{ $name['name'] }}</option>
                    @endforeach
                </select>

            </div>

            <div>
                <label for="country">Created Date:</label>

                <input type="date" name="user_created_at" class="user_created_at" id="user_created_at">

            </div>










            <div>
                <div>
                    <button id="search-btn" class="btn-sm btn-primary">Search</button>
                </div>


            </div>






        </div>




















        <!-- <button class="btn btn-warning" onclick="resetSelect()" type="button">Reset</button> -->



    </form>

</div>
<div id="loader"></div>


<div class="item">
    <input type="checkbox" id="toggleCheckbox" class="select-all"> Select All
    <button id="hiddenButtonMoveData" class="btn btn-success" style="display: none;">Move Data into Master Conferences</button>
    <table id="dtHorizontalExample2" class="table">
        <table id="table2" class="table">



        </table>



        <table id="mytable2" class="table"></table>


</div>



@endsection