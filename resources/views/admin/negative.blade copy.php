@extends('layouts.admindashboard')

@section('dashboard-content')


<head>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<style>
        .label {
    width: auto!important;
}
#reportrange {
            width: fit-content !important;

        }
</style>



</head>

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


function openfollowViewModal() {
            
            var viewmodal = document.getElementById('ViewFollowNegativeModal');
            viewmodal.style.display = 'block';
        }

        function closeFollowViewModal() {
            var viewmodal = document.getElementById('ViewFollowNegativeModal');
            viewmodal.style.display = 'none';
        }



document.addEventListener("DOMContentLoaded", function() {
            // Add an event listener to the button
            document.getElementById("formNegativesubmitBtn").addEventListener("click", function() {

                // Get the form element

        
                var followupnegativeForm = document.getElementById("NegativefollowupForm");

                // Toggle the "hidden" class to show/hide the form
                followupnegativeForm.classList.toggle("hidden");

                // Change the button text from "Add" to "Save"
                var mynewbutton = this.innerText;
                this.innerText = mynewbutton === "Add" ? "Save" : "Add";

                if (this.innerText === "Add") {
                saveForm3();
            }
            });
        });

      

        function updateModalFollowupContent3(followups) {

            // Get the comments container

            var commentsContainer = document.getElementById('FollowupNegativecommentsContainer');

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

               


                // Append the card to the container
                commentsContainer.appendChild(cardDiv);
            });
        }

        
        

        function saveForm3() {
            var formData = $('#followupForm').serialize(); // Serialize form data
            const article_id = $('#articleInput2').val();


            const email_id = $('#emailInput2').val();
            const conference_id = $('#conferenceInput2').val();
            const client_status_id = $('#client_status_id2').val();
            const comment = $('#comment').val();
            const followup_date = $('#negative_followup_date').val();
            const followup_type = $('#negative_followup_type').val();
            const note = $('#negative_note').val();
            const name = $('#nameInput2').val();


            $.ajax({
                type: 'POST',
                url: '{{route('admin.add.followupdata')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    article: article_id,
                    email: email_id,
                    conference: conference_id,
                    followup_date:followup_date,
                    followup_type:followup_type,
                    note:note,
                    name:name

                },
                success: function(response) {
                    // Handle success, if needed
                    console.log(response);
                    toastr.success(response.message);

                    $('#client_status_id').val('');
                    $('#comment').val('');
                    $('#emailInput2').val();
                    $('#conferenceInput2').val();
                    $('#client_status_id2').val();
                    $('#comment').val();
                    $('#followup_date_negative').val();
                    $('#followup_type').val();
                    $('#note').val();

                    console.log(response.followups);


                    updateModalFollowupContent3(response.followups);


                    // If submission is successful, hide the form and change button text back to "Add"
                    $('#NegativefollowupForm').addClass('hidden');
                    $('#formNegativesubmitBtn').text('Add');
                },
                error: function(xhr, status, error) {

                    var errors = xhr.responseJSON.errors;
                    handleValidationErrors(errors);
                },
            });
        }

        function handleValidationErrors(errors) {
            // Display validation errors as toasts
            for (var field in errors) {
                if (errors.hasOwnProperty(field)) {
                    toastr.error(errors[field][0]);
                }
            }
        }


        // Add an event listener to the "Save" button
       

    

</script>

<script>

function 


AddFollowNegativemakeAjaxCall(conference,article,email,name) {
    const url = `followups?conference=${conference}&article=${article}&email=${email}&name=${name}`;

        // Make an AJAX request to fetch comments
        fetch(url)  // Update the URL to your actual API endpoint
            .then(response => response.json())
            .then(data => {
                console.log(name,'my name');

                document.getElementById('articleInput2').value = article;
                document.getElementById('conferenceInput2').value = conference;
                document.getElementById('emailInput2').value =email;
                document.getElementById('nameInput2').value =name;




             


                // console.log(data.comments[0].article);


                // Update the modal content with comments
                updateModalFollowupContent3(data.followups);
            })
            .catch(error => console.error('Error fetching comments:', error));

        // Display the modal
        document.getElementById('ViewFollowNegativeModal').style.display = 'block';
    }
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
                    url: "{{ route('admin.negative.data') }}",
                    data: function(d) {

                        d.db = $('#db').val();
                        d.search = $('#search').val();
                        d.conference = $('#conference').val();
                        d.country = $('#country').val();

                        d.article = $('#article').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();

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
                        title: 'Created Date',
                        data: 'user_created_at'

                    },

                    {
                        title: 'Latest Comment Created Date ',
                        data: 'comment_created_date'

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
                    },
                    {
                        mData: '',
                        render: (data, type, row) => {
                            if (row.comments_count >= 1) {
                                const conference = row.conference;
                                const article = row.article;
                                const email = row.email;
                                const name = row.name;

                                return `<button class="custom-button" onclick="AddFollowNegativemakeAjaxCall('${conference}', '${article}', '${email}','${name}')">Add Follow up</button>`;
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

<div class="item">

<h5>All Negative Data</h5>

<div class="item">

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
