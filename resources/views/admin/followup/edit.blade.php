@extends('layouts.admindashboard') 

@section('dashboard-content')
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-header">{{ __('Update Follow up') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.followup.update',['id' => $user->id]) }}">
                        @csrf

                       
                     
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="followup_date" class="col-md-4 col-form-label text-md-end">{{ __('Followup Date') }}</label>

                            <div class="col-md-6">
                                <input id="follow_update" type="date" class="form-control @error('followup_date	') is-invalid @enderror" value="{{$user->followup_date}}" name="followup_date"  >

                                @error('followupdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email_sent_date" class="col-md-4 col-form-label text-md-end">{{ __('Followup Type') }}</label>

                            <div class="col-md-6">
                            <select class="form-control" name="followup_type" id="followup_type">
    <option value="">--choose one--</option>
    <option value="payment" {{ $user->followup_type == 'payment' ? 'selected' : '' }}>Payment</option>
    <option value="document" {{ $user->followup_type == 'document' ? 'selected' : '' }}>Document</option>
    <option value="reference" {{ $user->followup_type == 'reference' ? 'selected' : '' }}>Reference</option>
    <option value="confirmation" {{ $user->followup_type == 'confirmation' ? 'selected' : '' }}>Confirmation</option>
</select>
                                @error('email_sent_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_source" class="col-md-4 col-form-label text-md-end">{{ __('Note') }}</label>

                            <div class="col-md-6">

                            <textarea>{{$user->note}}</textarea>
                               
                            </div>
                        </div>


            


                      


                      
                     


                     






                       


                      



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
