@extends('layouts.app')

@section('content')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet">
    <title>Stripe Conferences</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700');

        .otp-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .otp-input {
            font-size: 20px;
            padding: 10px;
            width: 250px;
            text-align: center;
            margin: 0 5px;
        }

        .submit-btn,
        .clear-btn {
            font-size: 16px;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #a9afb3;
            color: #fff;
            border: none;
            border-radius: 14px;
            cursor: pointer;
        }

        .card {
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .card-header {
            color: white !important;
            background: #3366FF !important;
            text-align: center;
        }

        .card-header>img {
            width: 180px;
        }

        .input-container input {
            width: 40px;
            height: 40px;
        }

        .form-control:focus {
            box-shadow: none !important;
            border: 1px solid #3366FF !important;
        }

        .verify-btn {
            border-radius: 20px !important;
            border: 0px !important;
            width: 140px;
            background-color: #3366FF !important;
        }
    </style>

<script>
  function moveToNextInput(currentInput) {
    // Move to the next input field
    var nextInput = currentInput.nextElementSibling;
    if (nextInput) {
      nextInput.focus();
    }
  }

  function moveToPreviousInput(currentInput, event) {
    // Move to the previous input field if backspace is pressed
    if (event.key === 'Backspace') {
      var previousInput = currentInput.previousElementSibling;
      if (previousInput) {
        previousInput.focus();
      }
    }
  }

  function updateCompleteOtp() {
    // Get all OTP input values and update the hidden input field
    var otpInputs = document.getElementsByClassName('otp-input');
    var completeOtp = '';
    for (var i = 0; i < otpInputs.length; i++) {
      completeOtp += otpInputs[i].value;
    }
    document.getElementById('completeOtp').value = completeOtp;
  }
</script>
</head>

<form class="form-horizontal" method="POST" action="{{ route('user.postVerifyOTP') }}">
@csrf
    <div class="container d-flex justify-content-center align-items-center p-5">
        <div class="card text-center">
            <div class="card-header p-5">


                <img src="{{URL::asset('assets/images/error/forgot-password-frent-img.jpg')}}" class="img-fluid" alt="">


                <!-- <img src="assets\images\error\forgot-password-frent-img.jpg"> -->
                <h5 class="mb-2 mt-3">OTP VERIFICATION</h5>
                <div>
                    <small>OTP has been sent to your email. Valid for 5 minutes</small>
                </div>
            </div>
            <div class="otp-container p-5 mb-2">
                <h2>Enter 6-digit OTP</h2>


<input type="text" name="otp" class="otp-input" maxlength="6" required="">
                <!-- <input type="hidden" name="otp" value="" id="completeOtp" /> -->

<!-- 
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNextInput(this)" onkeydown="moveToPreviousInput(this, event)" required="">
<input type="text" class="otp-input" maxlength="1" oninput="moveToNextInput(this)" onkeydown="moveToPreviousInput(this, event)" required="">
<input type="text" class="otp-input" maxlength="1" oninput="moveToNextInput(this)" onkeydown="moveToPreviousInput(this, event)" required="">
<input type="text" class="otp-input" maxlength="1" oninput="moveToNextInput(this)" onkeydown="moveToPreviousInput(this, event)" required="">
<input type="text" class="otp-input" maxlength="1" oninput="moveToNextInput(this)" onkeydown="moveToPreviousInput(this, event)" required="">
<input type="text" class="otp-input" maxlength="1" oninput="moveToNextInput(this); updateCompleteOtp();" onkeydown="moveToPreviousInput(this, event)" required=""> -->
                <br>
                <button type="button" class="clear-btn" onclick="clearOTP()">Clear</button>
            </div>

            @if ($errors->has('otp'))
            <div class="invalid-feedback">
                {{ $errors->first('otp') }}
            </div>
            @endif


            @if ($errors->has('otp'))
            <span class="help-block mt-4">
                <strong>{{ $errors->first('otp') }}</strong>
            </span>
            @endif


            @if (session('otp_sent_success'))
            <div class="text-success mt-4">
                {{ session('otp_sent_success') }}
            </div>
            @endif
            <div>
                <small class="fs-6">
                    Didn't Get the OTP
                    <a href="#" class="text-decoration-none">Resend</a>
                </small>
            </div>
            <div class="mt-3 mb-5">
                <!-- <button type="submit" class="btn btn-success">Verify</button> -->

                <button typr="submit" class="btn btn-success px-4 verify-btn">verify</button>
            </div>
        </div>

    </div>

    </form>

   


    @endsection