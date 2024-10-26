@extends('layouts.auth')

@section('title')
    Reset Password
@endsection

@section('content')
<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center justify-content-center row-login">
                <div class="col-lg-4">
                    <h2>
                       Reset Password
                    </h2>
                    <form class="mt-3" method="POST" action="{{ route('forgot-password-reset-password', ['email' => $email, 'token' => $token]) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>New Password</label>
                            <input 
                                id="new_password" 
                                type="password" 
                                class="form-control @error('new_password') is-invalid @enderror",
                                name="new_password", 
                                required 
                                autocomplete="off"
                            >
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                          <div class="form-group">
                            <label>Confirm New Password</label>
                            <input 
                                id="confirm_new_password" 
                                type="password" 
                                class="form-control @error('confirm_new_password') is-invalid @enderror",
                                name="confirm_new_password", 
                                required 
                                autocomplete="off"
                            >
                            @error('confirm_new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="btn btn-success btn-block mt-4"
                        >
                          Reset Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css " rel="stylesheet">
@endpush

@push('addon-script')
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js "></script>

<script>
    let error_token="{{Session::get('error_token') ?? 'false'}}";
    let error_reset="{{Session::get('error_reset') ?? 'false'}}";

    if(error_token !== 'false'){
        Swal.fire({
            position: 'top-center',
            width: 650,
            icon: 'error',
            title: error_token,
            showConfirmButton: false,
            timer: 5000
        });
    }

    if(error_reset !== 'false'){
        Swal.fire({
            position: 'top-center',
            width: 650,
            icon: 'error',
            title: error_reset,
            showConfirmButton: false,
            timer: 5000
        });
    }
      
</script>
@endpush

