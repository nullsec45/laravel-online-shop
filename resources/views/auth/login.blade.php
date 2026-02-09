@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center row-login">
                <div class="col-lg-6 text-center">
                    <img
                    src="{{url('/images/login-placeholder.png')}}"
                    alt=""
                    class="w-50 mb-4 mb-lg-none"
                    />
                </div>
                <div class="col-lg-5">
                    <h2>
                        Belanja kebutuhan utama, <br />
                        menjadi lebih mudah
                    </h2>
                    <form method="POST" action="{{ route('login') }}" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" type="email" 
                                   class="form-control w-75 @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="email" autofocus>
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control w-75 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button
                            type="submit"
                            class="btn btn-success btn-block w-75 mt-4"
                        >
                            Sign In
                        </button>
                        <a
                            href="{{ route('register') }}"
                            class="btn btn-signup btn-block w-75 mt-2"
                        >
                            Sign Up
                        </a>
                        <div class="row w-75 mt-3">
                            <div class="col"><hr></div>
                            <div class="col-auto text-muted small">OR</div>
                            <div class="col"><hr></div>
                        </div>
                        <div class="mt-3">
                            <a href="{{route('auth.provider','google')}}" class="btn btn-danger btn-block w-75 mb-2">
                                <i class="fab fa-google mr-2"></i> Login with Google
                            </a>
                            <a href="{{route('auth.provider','facebook')}}" class="btn btn-primary btn-block w-75">
                                <i class="fab fa-facebook-f mr-2"></i> Login with Facebook
                            </a>
                        </div>

                        <div class="mt-4">
                            <a href="{{route('forgot-password')}}">
                                Forgot Password ?
                            </a>
                        </div>
                        <a href="{{route('forgot-password')}}" class="mt-4">
                            Forgot Password ?
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css " rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@push('addon-scipt')
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js "></script>
<script>
      let success_reset="{{Session::get('reset_success') ?? 'false'}}";

      if(success_reset !== 'false'){
            Swal.fire({
                // position: 'top-end',
                width: 600,
                icon: 'success',
                title: success_reset,
                showConfirmButton: false,
                timer: 2000
            });
        }
</script>
@endpush