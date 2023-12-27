<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- SideBar-Menu CSS -->

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">



    <

    <!-- //bootstap css cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Demo CSS -->
<!-- //toaster -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link href="https://cdn.datatables.net/v/bs5/jqc-1.12.4/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/sc-2.2.0/sb-1.6.0/datatables.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jqc-1.12.4/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/sc-2.2.0/sb-1.6.0/datatables.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <style>



table.dataTable > tbody > tr {
    /* display: inline-block; */
    white-space: nowrap; /* Prevent line breaks within the row */
    margin-right: 10px;
    height:auto; /* Add spacing between rows if necessary */
    
}

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

thead {
    border-top: none;
    font-size: small;
}

tbody tr>td {
    border-top: none;
    font-size: small;
}

.hidden {
    display: none;
}
    
.toast-message{
            color:black
        }

        .modal {
  position: fixed;
  top: -145px !important;
  left: 0;
  width: 100%;
  height: 810px !important;
  background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: black;
}

.ViewCommentsModal {
            display: none;
            position: fixed;
            top: -138px;
            left: 0;
            width: 100%;
            height: 500% !important;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            max-width: 80%;
            max-height: 80%;
            overflow-y: auto;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }


        .comment-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    /* Add more styling as needed */
}

.ViewFollowModal {
            display: none;
            position: fixed;
            top: -138px;
            left: 0;
            width: 100%;
            height: 280% !important;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            max-width: 80%;
            max-height: 80%;
            overflow-y: auto;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }


        .comment-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    /* Add more styling as needed */
}

.add-button {
        top: 0;
        right: 150px;
        margin: 10px; /* Adjust the margin as needed */
    }

    .button-container {
        display: flex;
        gap: 10px; /* Adjust the gap as needed */
    }

    .label{
        width: 21rem !important;

    }

    .md-6{
        display: flex;

    }

    .row{
        display: flex !important;
        margin-left: 0px !important;
        margin-right: 0px !important;
        align-items: center !important;

    }

    .form-control {
        width: auto !important;
        display: inline;
    }
    

</style>


    <script>
        $(document).ready(function() {
            $(".hamburger .hamburger__inner").click(function() {
                $(".wrapper").toggleClass("active")
            })

            $(".top_navbar .fas").click(function() {
                $(".profile_dd").toggleClass("active");
            });
        })
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
        $(document).ready(function() {
            var myTable; // Declare a variable to store the DataTable object


            myTable = $('#dtHorizontalExample').DataTable({
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
                    url: "{{ route('admin.users') }}",
                    data: function(d) {

                        d.db = $('#db').val();
                        d.search = $('#search').val();
                        d.conference = $('#conference').val();
                        d.country = $('#country').val();
                       d.article=$('#article').val();
                       d.user=$('#user').val();
                       d.user_created_at=$('#user_created_at').val();
                       d.user_updated_at=$('#user_updated_at').val();
                       d.email_status=$('#email_status').val();
                       d.client_status=$('#client_status').val();


                       


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
        },        success: function(response) {
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

            $('#search-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission behavior
                myTable.ajax.reload();
            });


            $('#searchButton').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                myTable.ajax.reload();

            });

            $('#dtHorizontalExample tbody').on('change', '.checkbox', function() {
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
        // Wait for the document to be ready
        $(document).ready(function() {
            // Attach a click event handler to the search button
            $("#MainClearBtn").click(function(e) {
                e.preventDefault();
                var inputData = $('#search').val();
                $('#search').val('');

            });
        });

        
    </script>


    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Attach a click event handler to the search button
            $("#Reset").click(function(e) {
                alert();
                e.preventDefault();
                $('#form')[0].reset();
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
        $(document).ready(function() {
            // Set default selected value
            //   var defaultCountry = 'all';

            // Set the default value in the dropdown
            var my = $('#country').val();



            if (typeof my !== 'undefined') {

                var my = $('#country').val();



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

                    var url = "{{ route('admin.all.conferences', ['id' => 'id']) }}";
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

                    var url = "{{ route('admin.all.conferences', ['id' => 'id']) }}";
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

                

            }

            // Trigger the change event to make the AJAX request


        });

        function displayconferenceNames(conferenceNames) {
                    var html = '<select id="conference" class="conference"> <option>All</option>';

                    $.each(conferenceNames, function(index, conferenceName) {
                        html += '<option>' + conferenceName + '</option>';
                    });
                    html += '</select>';
                    return html;
                }
    </script>

    <style>
        .dtHorizontalExample td {
            white-space: nowrap;
        }

        .custom-message {
            color: green;
            font-weight: bold;
            /* Add any other styles you want */
        }


        select {
            word-wrap: normal;
            width: 150px;
        }


        .dtHorizontalExample tbody tr {
            min-height: 3px;
            /* or whatever height you need to make them all consistent */
        }

        .card {
            width: auto !important;
            top: 80px;

        }

        .alert {
            width: fit-content;
        }

        /* Apply text wrapping to the first column */
        #dtHorizontalExample td:first-child {
            white-space: normal;
            /* Enable text wrapping */
        }

        .text-wrap {
            white-space: normal;
        }

        .width-200 {
            width: 200px;
        }
    </style>
</head>

<div class="wrapper">
    <div class="top_navbar">
        <div class="hamburger">
            <div class="hamburger__inner">
                <div class="one"></div>
                <div class="two"></div>
                <div class="three"></div>
            </div>
        </div>
        <div class="menu">
            <div class="logo">
                STRIPE
            </div>
            <div class="right_menu">
                <ul>
                    <li><i class="fas fa-user"></i>
                        <div class="profile_dd">
                            <div class="dd_item">Profile</div>
                            <div class="dd_item">Change Password</div>
                            <div class="dd_item" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main_container">
        <div class="sidebar">
            <div class="sidebar__inner">
                <div class="profile">
                    <div class="img">


                        <img src="{{URL::asset('img/pic.png')}}" alt="profile_pic">

                    </div>
                    <div class="profile_info">
                        <p>Welcome</p>
                        <p class="profile_name">

                        

                              @if (Auth::check())
                                {{ Auth::user()->name }}
                                @endif      
                        </p>
                    </div>
                </div>
                <ul>


                <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ ((Request::is('admin/dashboard')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fas fa-dice-d6"></i></span>
                            <span class="title">Home</span>
                        </a>

                </li>


                


                

             
              
                    <li>
                        <a href="{{ route('admin.show.conferences') }}" class="{{ ((Request::is('admin/conferences')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fas fa-dice-d6"></i></span>
                            <span class="title">Conferences</span>
                        </a>

                    </li>


                    <li>
                        <a href="{{ route('admin.show.positive') }}" class="{{ ((Request::is('admin/conferences')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fas fa-dice-d6"></i></span>
                            <span class="title">Postive</span>
                        </a>

                    </li>


                    <li>
                        <a href="{{ route('admin.show.negative') }}" class="{{ ((Request::is('admin/conferences')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fas fa-dice-d6"></i></span>
                            <span class="title">Negative</span>
                        </a>

                    </li>


                    <li>
                        <a href="{{ route('admin.show.followup') }}" class="{{ ((Request::is('admin/conferences')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fas fa-dice-d6"></i></span>
                            <span class="title">Follow up</span>
                        </a>

                    </li>


                    <li>
                        <a href="{{route('admin.show.upload')}}" class="{{ ((Request::is('admin/show')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fab fa-delicious"></i></span>
                            <span class="title">Upload</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.show.recentdata')}}" class="{{ ((Request::is('show-upload-form')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fab fa-delicious"></i></span>
                            <span class="title">Recent Data</span>
                        </a>
                    </li>
                 
                    <li>
                        <a href="{{route('admin.show.report')}}" class="{{ ((Request::is('admin/show-report')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fas fa-chart-pie"></i></span>
                            <span class="title">Reports</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.show.allusers')}}" class="{{ ((Request::is('admin/show-allusers')) ? 'active' : ' ') }}">
                            <span class="icon"><i class="fas fa-chart-pie"></i></span>
                            <span class="title">All Users</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="container">

            @yield('dashboard-content')

        </div>

        <div class="conatiner">
            <div id="ViewCommentsModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">

                    <div class="row">
                        <form id="myForm2" class="hidden">
                            @csrf

                            <div class="row">
                                <div class="md-6">


                                    <input type="text" id="articleInput" hidden>
                                    <input type="text" id="conferenceInput" hidden>
                                    <input type="text" id="emailInput" hidden>

                                    <input type="text" id="nameInput" hidden>


                                    <label class="label">Select Client Status</label>
                                    <select class="custom-select" id="client_status_id">
                                        <option>--select--</option>

                                        <option value="">--Choose--</option>

                                        <option value="1">Positive</option>
                                        <option value="2">Negative</option>

                                    </select>
                                </div>
                                <div>
                                    <span class="col-md-6">
                                        <label>Write comment</label>
                                        <input class="form-control" type="text" id="comment">
                                    </span>
                                </div>

                            </div>

                        </form>
                        <button class="add-button btn btn-primary btn-sm" id="showFormBtn2">Add</button>

                        <span class="close" onclick="closeViewModal()">&times;</span>

                    </div>






                    <div id="commentsContainer">
                        <!-- Comments will be dynamically inserted here -->
                    </div>
                </div>
            </div>

            <div id="ViewFollowModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">

                    <div class="row">
                        <form id="followupForm" class="hidden">
                            @csrf

                            <div class="row justify-content-center">
                                <div class="md-6">


                                    <input type="text" id="articleInput2" hidden>
                                    <input type="text" id="conferenceInput2" hidden>
                                    <input type="text" id="emailInput2" hidden>


                                    <label class="label">Follow up Date</label>
                                   <input type="date"  class="form-control" id="followup_date" name="followup_date">
                                </div>
                                <div>
                                    <span class="col-md-6">
                                        <label>Followup Type</label>
                                        <select class="form-control" name="followup_type" id="followup_type">
                                            <option value="">--choose one--</option>
                                            <option value="payment">Payment</option>
                                            <option value="document">Document</option>
                                            <option value="reference">reference</option>
                                            <option value="confirmation">Confirmation</option>

                                        </select>
                                    </span>
                                </div>

                                <div>
                                <span class="col-md-6">
                                        <label>Notes</label>
                                        <textarea  id="note" name="note"></textarea>
                                </span>


                                </div>

                                

                               

                            </div>

                        </form>
                        <button class="add-button btn btn-primary btn-sm" id="formsubmitBtn">Add</button>

                        <span class="close" onclick="closeFollowViewModal()">&times;</span>

                    </div>






                    <div id="FollowupcommentsContainer">
                        <!-- Comments will be dynamically inserted here -->
                    </div>
                </div>
            </div>

            <div id="ViewFollowNegativeModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">

                    <div class="row">
                        <form id="NegativefollowupForm" class="hidden">
                            @csrf

                            <div class="row justify-content-center">
                                <div class="md-6">


                                    <input type="text" id="articleInput2" hidden>
                                    <input type="text" id="conferenceInput2" hidden>
                                    <input type="text" id="emailInput2" hidden>
                                    <input type="text" id="nameInput2" hidden>



                                    <label class="label">Follow up Date</label>
                                   <input type="date"  class="form-control" id="negative_followup_date" name="negative_followup_date">
                                </div>
                                <div>
                                    <span class="col-md-6">
                                        <label>Followup Type</label>
                                        <select class="form-control" name="negative_followup_type" id="negative_followup_type">
                                            <option value="">--choose one--</option>
                                            <option value="payment">Payment</option>
                                            <option value="document">Document</option>
                                            <option value="reference">reference</option>
                                            <option value="confirmation">Confirmation</option>

                                        </select>
                                    </span>
                                </div>

                                <div>
                                <span class="col-md-6">
                                        <label>Notes</label>
                                        <textarea  id="negative_note" name="negative_note"></textarea>
                                </span>


                                </div>

                                

                               

                            </div>

                        </form>
                        <button class="add-button btn btn-primary btn-sm" id="formNegativesubmitBtn">Add</button>

                        <span class="close" onclick="closeFollowViewModal()">&times;</span>

                    </div>






                    <div id="FollowupNegativecommentsContainer">
                        <!-- Comments will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add an event listener to the button
            document.getElementById("showFormBtn2").addEventListener("click", function() {

                // Get the form element
                var form2 = document.getElementById("myForm2");

                // Toggle the "hidden" class to show/hide the form
                form2.classList.toggle("hidden");

                // Change the button text from "Add" to "Save"
                var buttonText = this.innerText;
                this.innerText = buttonText === "Add" ? "Save" : "Add";
            });
        });

        function saveForm() {
            var formData = $('#myForm2').serialize(); // Serialize form data
            const article_id = $('#articleInput').val();
            const email_id = $('#emailInput').val();
            const conference_id = $('#conferenceInput').val();
            const client_status_id = $('#client_status_id').val();




            
            const comment = $('#comment').val();





            $.ajax({
                type: 'POST',
                url: '{{route('admin.add.comments')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    article: article_id,
                    email: email_id,
                    client_status_id: client_status_id,
                    comment: comment,
                    conference: conference_id,

                },
                success: function(response) {
                    // Handle success, if needed
                    console.log(response);
                    toastr.success(response.message);

                    $('#client_status_id').val('');
                    $('#comment').val('');

                    console.log(response.comments);


                    updateModalContent2(response.comments);


                    // If submission is successful, hide the form and change button text back to "Add"
                    $('#myForm2').addClass('hidden');
                    $('#showFormBtn2').text('Add');
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
        document.getElementById("showFormBtn2").addEventListener("click", function() {
            // Check if the button text is "Save" and submit the form if it is
            if (this.innerText === "Save") {
                saveForm();
            }
        });
    </script>


 <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add an event listener to the button
            document.getElementById("formsubmitBtn").addEventListener("click", function() {

                // Get the form element

        
                var followupForm = document.getElementById("followupForm");

                // Toggle the "hidden" class to show/hide the form
                followupForm.classList.toggle("hidden");

                // Change the button text from "Add" to "Save"
                var mybutton = this.innerText;
                this.innerText = mybutton === "Add" ? "Save" : "Add";
            });
        });


       

        function updateModalFollowupContent2(followups) {
            // Get the comments container
            var commentsContainer = document.getElementById('FollowupcommentsContainer');

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
        

        function saveForm2() {
            var formData = $('#followupForm').serialize(); // Serialize form data
            const article_id = $('#articleInput2').val();


            const email_id = $('#emailInput2').val();
            const conference_id = $('#conferenceInput2').val();
            const client_status_id = $('#client_status_id2').val();
            const comment = $('#comment').val();
            const followup_date = $('#followup_date').val();
            const followup_type = $('#followup_type').val();
            const note = $('#note').val();
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
                    $('#followup_date').val();
                    $('#followup_type').val();
                    $('#note').val();

                    console.log(response.followups);


                    updateModalFollowupContent2(response.followups);


                    // If submission is successful, hide the form and change button text back to "Add"
                    $('#followupForm').addClass('hidden');
                    $('#formsubmitBtn').text('Add');
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
        document.getElementById("formsubmitBtn").addEventListener("click", function() {
            // Check if the button text is "Save" and submit the form if it is
            if (this.innerText === "Save") {
                saveForm2();
            }
        });
    </script>






    <script>
        function openViewModal() {
            var viewmodal = document.getElementById('ViewCommentsModal');
            viewmodal.style.display = 'block';
        }

        function closeViewModal() {
            var viewmodal = document.getElementById('ViewCommentsModal');
            viewmodal.style.display = 'none';
        }


        // Function to update modal content with comments
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



        function makeAjaxCall(conference, article, email) {
            const url = `comments?conference=${conference}&article=${article}&email=${email}`;

            // Make an AJAX request to fetch comments
            fetch(url) // Update the URL to your actual API endpoint
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

        function makeAjaxCall2(conference, article, email) {
            // Assuming you are using the XMLHttpRequest object for AJAX
            var xhr = new XMLHttpRequest();

            console.log(conference, article, email);


            const url = `comments?conference=${conference}&article=${article}&email=${email}`;

            // Configure the AJAX request
            xhr.open('GET', url, true);

            // Set up a callback function to handle the response
            xhr.onload = function(response) {

                console.log(response);
                if (xhr.status == 200) {
                    // If the AJAX request is successful, call openModal()
                    openViewModal();
                } else {
                    // Handle errors if the AJAX request fails
                    console.error('AJAX request failed');
                }
            };

            // Send the AJAX request
            xhr.send();
        }

        // Call the makeAjaxCall() function to initiate the AJAX request
    </script>