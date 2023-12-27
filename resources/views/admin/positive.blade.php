@extends('layouts.admindashboard')

@section('dashboard-content')

<head>
    <style>
        .label {
            width: auto !important;
        }

        #reportrange {
            width: fit-content !important;

        }
    </style>
</head>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


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

<script>
    function resetSelect() {
        // Get the select element by its id
        var selectElement = document.getElementById('country');

        // Set the selectedIndex to 0 to reset to the first option
        selectElement.val().reset();
    }



    function openfollowViewModal() {

        var viewmodal = document.getElementById('ViewFollowModal');
        viewmodal.style.display = 'block';
    }

    function closeFollowViewModal() {
        var viewmodal = document.getElementById('ViewFollowModal');
        viewmodal.style.display = 'none';
    }


    function updatefollowModalContent2(comments) {
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

    function AddFollowmakeAjaxCall(conference, article, email, name) {

        const url = `followups?conference=${conference}&article=${article}&email=${email}&name=${name}`;

        // Make an AJAX request to fetch comments
        fetch(url) // Update the URL to your actual API endpoint
            .then(response => response.json())
            .then(data => {
                console.log(data.followups);

                document.getElementById('articleInput2').value = article;
                document.getElementById('conferenceInput2').value = conference;
                document.getElementById('emailInput2').value = email;

                document.getElementById('nameInput2').value = name;






                // console.log(data.comments[0].article);


                // Update the modal content with comments
                updateFollowModalContent(data.followups);
            })
            .catch(error => console.error('Error fetching comments:', error));

        // Display the modal
        document.getElementById('ViewFollowModal').style.display = 'block';
    }


    function updateFollowModalContent(followups) {

        console.log(followups);
        // Get the comments container
        const commentsContainer = document.getElementById('FollowupcommentsContainer');

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
</script>


<script>
    $(document).ready(function() {
        $('.country').select2();
        $('.conference').select2();

    });
</script>




<script>
    $(document).ready(function() {
        var myTable; // Declare a variable to store the DataTable object


        myTable = $('#PositivedtHorizontalExample').DataTable({
            "scrollX": true,


            "columnDefs": [{
                "targets": [4], // Assuming "Street" is the second column (index 1)
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
            buttons: [
                'excel'
            ],
            // 'responsive': true,

            processing: true,
            serverSide: true,
            autoWidth: false,
            recordsTotal: 50,
            ajax: {
                url: "{{ route('admin.positive.data') }}",
                data: function(d) {

                    d.db = $('#db').val();
                    d.search = $('#search').val();
                    d.conference = $('#conference').val();

                    d.start_date = $('#start_date').val();

                    d.end_date = $('#end_date').val();


                    d.country = $('#country').val();
                    d.article = $('#article').val();
                    d.user = $('#user').val();
                    d.user_created_at = $('#user_created_at').val();
                    d.user_updated_at = $('#user_updated_at').val();




                    var conference_id = $('#conference').val();

                    var county_id = $('#country').val();

                    var dba = $('#db').val();

                    var search = d.search = $('#search').val();


                    console.log(search);


                }
            },

            columns: [{
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
                    title: 'Email Sent Date',
                    data: 'email_sent_date'

                },




                {
                    title: 'Posted By',
                    data: 'posted_by'

                },


                {
                    title: 'Latest Comment Created Date ',
                    data: 'comment_created_date'

                },


                {
                    title: 'Created Date',
                    data: 'user_created_at'

                },
                {
                    title: 'User Updated Date',
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
                },
                {
                    mData: '',
                    render: (data, type, row) => {
                        if (row.comments_count >= 1) {
                            const conference = row.conference;
                            const article = row.article;
                            const email = row.email;
                            const name=row.name;
                            return `<button class="custom-button" onclick="AddFollowmakeAjaxCall('${conference}', '${article}', '${email}','${name}')">Add Follow up</button>`;
                        } else {
                            // Optionally, you can provide an alternative content or an empty string if you don't want to show anything.
                            return '';
                        }
                    }
                }




            ],

        });

        $('.btn.btn-secondary.buttons-excel.buttons-html5').on('click', function() {
            // Trigger the Excel export

            var columnNameToSearch = 'Email';

            var columnIndex = myTable.column(':contains(' + columnNameToSearch + ')').index();
            console.log(columnIndex);

            var allData = myTable.rows().data().toArray();

            var emails = allData.map(function(row) {
                return row['email'];
            });


            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{route('admin.download.email')}}',
                method: 'POST', // or 'GET' depending on your server-side implementation
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


        $('#PositivedtHorizontalExample').on('click', '.show-more', function() {
            var $row = $(this).closest('tr');
            var $moreText = $row.find('.more-text');
            var $ellipsis = $row.find('.ellipsis');

            $ellipsis.hide();
            $moreText.show();
            $(this).text('Less').removeClass('show-more').addClass('show-less');
        });

        $('#PositivedtHorizontalExample').on('click', '.show-less', function() {
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

        $('#PositivedtHorizontalExample tbody').on('change', '.checkbox', function() {
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


<script>

$(document).ready(function () {
  $("form").submit(function (event) {

    alert();
    var formData = {
      name: $("#name").val(),
      email: $("#email").val(),
      superheroAlias: $("#superheroAlias").val(),
    };

    $.ajax({
      type: "POST",
      url: "process.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
    });

    event.preventDefault();
  });
});

</script>

<script>

$(document).ready(function () {
    $('#myForm').submit(function (e) {
        // Prevent the default form submission
        e.preventDefault();

        // Get form data
        var formData = {
            name: $('#name').val(),
            email: $('#email').val()
        };

        // Make AJAX request
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.positive.data') }}",
            data: formData,
            success: function (data) {
                // Handle the response from the server
                $('#result').html('Data submitted successfully: ' + data);
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    });
});


</script>



<div class="item">

    <h5>All Positive Data</h5>


    <div class="item">

        <form id="form">

            <div class="row">



                <div>
                    <label for="country"> Country:</label>
                    <select id="country" name="country" class="country">
                        <option value="All">All</option>
                        @foreach($countries as $code => $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>

                </div>

                <div>
                    <label for="conference">Conferences:</label>
                    <select id="conference" name="conference" class="conference" style="width:auto">

                        <option value="All">All conference Names</option>

                    </select>


                </div>

                <div>
                    <input type="date" id="start_date" hidden name="start_date" />
                    <input type="date" id="end_date" hidden name="end_date" />

                </div>




                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>




                <div>
                    <button id="searchButton" class="btn btn-primary btn-sm">Search</button>
                </div>





            </div>

        </form>


    </div>


    <div class="item">
        <input type="checkbox" id="toggleCheckbox" class="select-all" disabled> Select All
        <button id="hiddenButton" class="btn btn-success" style="display: none;">Sent Email</button>
        <table id="PositivedtHorizontalExample" class="table">
            <table id="table2" class="table">
            </table>
            <table id="mytable2" class="table"></table>


    </div>


    @endsection