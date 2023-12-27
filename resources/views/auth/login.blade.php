@extends('layouts.app')
 
@section('content')
<main class="authentication-content">
    <div class="container">
        <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
                <div class="row g-0">
                    <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                        <img src="{{URL::asset('assets/images/error/auth-img-7.png')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-12 col-xl-4 order-xl-2">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title text-center fs-2 fw-bold">{{ __('User Login') }}</h5>
                            <p class="card-text mb-4 text-center">See your growth and get support!</p>
                            <div class="form-body">
                                <form action="{{ route('user.loginWithOTP') }}" id="loginform" method="post">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                            <div class="ms-auto position-relative">
                                                <div
                                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                    <i class="bi bi-envelope"></i>
                                                </div>
                                                <input id="email" type="email"
                                                    class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit"
                                                    class="btn btn-primary radius-30" placeholder="Next">{{ __('Login') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
 
<!-- Bootstrap bundle JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
 
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/pace.min.js"></script>