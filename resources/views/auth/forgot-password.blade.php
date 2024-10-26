@extends('layouts.auth')

@section('title')
    Forgot Password
@endsection

@section('content')
<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center justify-content-center row-login">
                <div class="col-lg-4">
                    <h2>
                       Forgot Password
                    </h2>
                    <form class="mt-3" method="POST" action="{{ route('forgot-password-send-token') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label>Email Address</label>
                            <input 
                                v-model="email"
                                @change="checkForEmailAvailability()"
                                id="email" 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                :class="{ 'is-invalid': this.email_unavailable }"
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email"
                            >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                        <button
                            type="submit"
                            class="btn btn-success btn-block mt-4"
                            :disabled="this.email_unavailable">
                            Send Link Reset
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                            Back to Sign In
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
@endpush

@push('addon-script')
    <script src="{{url('/vendor/vue/vue.js')}}"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js "></script>

    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
       
        },
        methods: {
            checkForEmailAvailability: function () {
                var self = this;
                axios.get('{{ route('api-check-registered') }}', {
                        params: {
                            email: this.email
                        }
                    })
                    .then(function (response) {
                        if(response.data == 'Registered') {
                            self.$toasted.show(
                                "Email terdaftar! Silahkan klik tombol send link reset.!", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = false;
                        } else {
                            self.$toasted.error(
                                "Maaf, tampaknya email belum terdaftar pada sistem kami.", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = true;
                        }
                        // handle success
                        console.log(response.data);
                    })
            }
        },
        data() {
            return {
                name: "",
                email: "",
                is_store_open: "",
                store_name: "",
                email_unavailable: ""
            }
        },
      });

      let error_token="{{Session::get('link_error') ?? 'false'}}";
      let success_token="{{Session::get('link_success') ?? 'false'}}";

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

        if(success_token !== 'false'){
              Swal.fire({
                // position: 'top-end',
                width: 600,
                icon: 'success',
                title: success_token,
                showConfirmButton: false,
                timer: 2000
            });
        }
      
    </script>
@endpush