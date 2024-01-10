@extends('layouts.admindashboard')

@section('dashboard-content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<script>



        function closeFollowViewModal() {
            var viewmodal = document.getElementById('ViewFollowModal');
            viewmodal.style.display = 'none';
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

     function AddFollowup(conference, article, email, name) {

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
</script>

<script>
        $(document).ready(function() {
            var myTable; // Declare a variable to store the DataTable object


            myTable = $('#FollowupHorizontalExample').DataTable({
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
                    url: "{{ route('admin.followup.data') }}",
                    data: function(d) {

                        d.db = $('#db').val();
                        d.search = $('#search').val();
                        d.conference = $('#conference').val();
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
                        title: 'Next  Followup Date',
                        data: 'followup_date'

                    },

                    {
                        title: 'Followup Date Created Date',
                        data: 'followup_created_date'

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
                        title: 'Created Date',
                        data: 'created_at'

                    },
                    {
                        title: 'Updated Date',
                        data: 'updated_at'
                    },

                    {
                    title: 'Action',

                    mData: '',
                    render: (data, type, row) => {
                            const conference = row.conference;
                            const article = row.article;
                            const email = row.email;
                            const name=row.name;
                            return `<button class="custom-button" onclick="AddFollowup('${conference}', '${article}', '${email}','${name}')">Add Follow up</button>`;
                        
                    }



                },
                


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


            $('#FollowupHorizontalExample').on('click', '.show-more', function() {
                var $row = $(this).closest('tr');
                var $moreText = $row.find('.more-text');
                var $ellipsis = $row.find('.ellipsis');

                $ellipsis.hide();
                $moreText.show();
                $(this).text('Less').removeClass('show-more').addClass('show-less');
            });

            $('#FollowupHorizontalExample').on('click', '.show-less', function() {
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

            $('#FollowupHorizontalExample tbody').on('change', '.checkbox', function() {
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

<h5>All Followup Data</h5>


<div class="item">
<input type="checkbox" id="toggleCheckbox" class="select-all" disabled> Select All
<button id="hiddenButton" class="btn btn-success" style="display: none;">Sent Email</button>
    <table id="FollowupHorizontalExample" class="table">



    <table id="table2" class="table">

    
       
    </table>



    <table id="mytable2" class="table"></table>


</div>


@endsection 
