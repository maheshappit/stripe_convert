@extends('layouts.dashboard_header')
@section('content')

<main class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">Conferences</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:;">
                                            <i class="bi bi-grid-fill"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Upload New Conference</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- <div class="ms-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Settings</button>
                                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                    <a class="dropdown-item" href="javascript:;">Action</a>
                                    <a class="dropdown-item" href="javascript:;">Another action</a>
                                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:;">Separated link</a>
                                </div>
                            </div></div> -->
                    </div>
                    <!--end breadcrumb-->
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="card">
                                <div class="card-header py-3 bg-transparent">
                                    <h5 class="mb-0">Upload New Conferences</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border p-3 rounded">

                                        <form id="uploadForm" class="row g-3" enctype="multipart/form-data">

                                            @csrf
                                            <div class="col-12">
                                                <label class="form-label">Upload File:</label>

                                                <input class="form-control" type="file" name="csvFile" accept=".csv">

                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Conferences:</label>
                                                <select class="form-select" name="conference">
                                    <option value="">Choose Conferences</option>
                                    @foreach($all_conferences as $conference)
                                    <option value="{{$conference}}">{{ $conference }}</option>
                                    @endforeach
                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email Status</label>
                                                <select class="form-select">
                                                    <option>Choose One</option>
                                                    <option>Sent</option>
                                                    <option>Pending</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <button id="uploadButton"  class="btn btn-primary px-4">Submit</button>
                                            </div>
                                            <a href="assets/Sample.csv" download="">Sample File Download</a>
                                        </form>

                                        <div id="message" style="color: green"></div>
    <div id="error-message" style="color: red"></div>

    <div id="inserted_count" style="color: green"></div>
    <div id="updated_count" style="color: blue"></div>
    <div id="erros_count" style="color: red"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </main>


                <script>
    $('#uploadForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        document.getElementById('uploadButton').disabled = true;


        $.ajax({
            xhr: function(res) {
                var xhr = new window.XMLHttpRequest();




                if (xhr.status === 0) {

                    
                    $('#message')
                        .text('Data Uploading, please wait...')
                        .css({
                            'font-size': '16px',
                            'color': 'green',
                            'font-weight': 'bold'
                            // Add any other styles you want to apply
                        })
                        .show();
                } else if (xhr.status === 200) {
                    $('#message').remove();

                    $('#error-message').remove();



                    $('#message')
                        .text('Data uploaded success')
                        .css({
                            'font-size': '16px',
                            'color': 'green',
                            'font-weight': 'bold'
                            // Add any other styles you want to apply
                        })
                        .show();

                }
                return xhr;
            },

            url: '{{ route('user.upload') }}', // Using Laravel's route helper
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#error-message').remove();

                $('#message').text(response.message).show();
                $('#inserted_count').text(response.inserted_count).show();
                $('#updated_count').text(response.updated_count).show();




                document.getElementById('uploadButton').disabled = false;

            },
            error: function(error) {
                var errorResponse = JSON.parse(error.responseText);
                var errorMessage = 'Error: ' + errorResponse.message;
                if (errorResponse.errors) {
                    errorMessage += '<br>';
                    Object.keys(errorResponse.errors).forEach(function(key) {
                        errorMessage += errorResponse.errors[key][0] + '<br>';
                    });
                }
                $('#message').remove();

                $('#error-message').html(errorMessage).show();
                document.getElementById('uploadButton').disabled = false;

            }
        });
    });
</script>
                

@endsection