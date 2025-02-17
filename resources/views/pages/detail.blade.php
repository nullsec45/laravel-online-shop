@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection
@section('content')
<div class="page-content page-details">
    <section
      class="store-breadcrumbs"
      data-aos="fade-down"
      data-aos-delay="100"
    >
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{route('home')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Product Details
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section class="store-gallery mb-3" id="gallery">
      <div class="container">
        <div class="row">
          <div class="col-lg-8" data-aos="zoom-in">
            <transition name="slide-fade" mode="out-in">
              <img
                :src="photos[activePhoto].url"
                :key="photos[activePhoto].id"
                class="w-100 main-image"
                alt=""
              />
            </transition>
          </div>
          <div class="col-lg-2">
            <div class="row">
              <div
                class="col-3 col-lg-12 mt-2 mt-lg-0"
                v-for="(photo, index) in photos"
                :key="photo.id"
                data-aos="zoom-in"
                data-aos-delay="100"
              >
                <a href="#" @click="changeActive(index)">
                  <img
                    :src="photo.url"
                    class="w-100 thumbnail-image"
                    :class="{ active: index == activePhoto }"
                    alt=""
                  />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="store-details-container" data-aos="fade-up">
      <section class="store-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h1>{{ $product->name }}</h1>
                <div>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </div>
              <div class="owner">By {{ $product->user->store_name }}</div>
              <div class="price">${{ number_format($product->price) }}</div>
            </div>
            <div class="col-lg-2" data-aos="zoom-in">
              @auth
                  <form action="{{ route('cart-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button
                      type="submit"
                      class="btn btn-success px-4 text-white btn-block mb-3"
                    >
                      Add to Cart
                    </button>
                  </form>
              @else
                  <a
                    href="{{ url('login') }}"
                    class="btn btn-success px-4 text-white btn-block mb-3"
                  >
                    Sign in to Add
                  </a>
              @endauth
            </div>
          </div>
        </div>
      </section>
      <section class="store-description">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8">
              {!! $product->description !!}
            </div>
          </div>
        </div>
      </section>
      <section class="comment-section" id="addReviewSection">
        <div class="container"> 
          <div class="row">
              <div class="col-lg-3">
                  <button type="submit" 
                          class="btn btn-success px-4 text-white btn-block mb-3"
                          @click="toggleReviewContainer"
                  >
                    <span v-if="isAuthenticated">Review</span>
                    <span v-else>Sign to review</span>
                  </button>
            </div>
          </div>
          <form action="{{route("add-reviews",$product->id)}}" method="POST">
            @csrf()
            <div class="row" v-if="showReviewContainer">
              <div class="col-lg-10">
                <div class="form-group">
                  <label for="product_reviews">Review</label>
                    <div>
                      <span class="fa fa-star" v-for="star in 5" :key="star"></span>
                    </div>
                    <textarea class="form-control" id="product_reviews" name="product_reviews" rows="3"></textarea>
                </div>
              </div>
              <div class="col-2">
                      <button
                        type="submit"
                        class="btn btn-success px-4 text-white btn-block mb-3"
                      >
                        Add Review
                      </button>
                </div>
            </div>
          </form>
        </div>
      </section>
      <section class="store-review" id="reviewSection">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mt-3 mb-3">
              <h5>Customer Review ({{count($reviews)}})</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-8">
              <ul class="list-unstyled">
    
              @foreach($reviews as $review)
                <li class="media">
                  <img
                    src="{{url("/images/icons-testimonial-2.png")}}"
                    alt=""
                    class="mr-3 rounded-circle"
                  />
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">{{$review['user_name']}}</h5>
                    <p>{{$review['comment']}}</p>
                     <button class="btn btn-primary btn-sm" @click="editReview(index)">Edit</button>
                     <button class="btn btn-danger btn-sm ml-2" 
                              @click="confirmDelete({{ $review['id'] }},{{ $review['product_id'] }})"
                      >
                      Delete
                    </button>
                  </div>
                </li>
              @endforeach
              </ul>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection

@push('addon-style')
<style>
.fa-star {
  color: #ffc107;
  margin-right: 5px;
}
</style>
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css " rel="stylesheet">
@endpush

@push('addon-script')
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js "></script>
<script src="{{url("/vendor/vue/vue.js")}}"></script>
<script>
  var gallery = new Vue({
    el: "#gallery",
    mounted() {
      AOS.init();
    },
    data: {
      activePhoto: 0,
      photos: [
        @foreach ($product->galleries as $gallery)
        {
          id: {{ $gallery->id }},
          url: "{{ asset('storage/assets/products/'.$gallery->photos) }}",
        },
        @endforeach
      ],
    },
    methods: {
      changeActive(id) {
        this.activePhoto = id;
      },
    },
  });

  let dataReviewSection={
      showReviewContainer: false,
      isAuthenticated: false, 
  }

  @auth
      dataReviewSection.isAuthenticated=true;
  @endauth

  var addReviewSection = new Vue({
    el: "#addReviewSection",
    data:dataReviewSection,
    methods: {
      toggleReviewContainer() {
        if (this.isAuthenticated) {
          this.showReviewContainer = !this.showReviewContainer;
        } else {
          alert('Please sign in to add a review.');
          window.location.href="{{route('login')}}" 
        }
      },
    },
  });

  var reviewSection=new Vue({
    el:'#reviewSection',
    methods:{
      deleteReview(reviewId,productId){
        fetch(`{{ url('products/review') }}/${reviewId}/${productId}`,{
          method:"DELETE",
          headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
          }
        }).then((res) => {
          return res.json();
        }).then((res) => {
          if(!res.success){
            Swal.fire({
              icon: "error",
              title: "Failed to delete review...",
              text: res.message,
            });
          }else{
            Swal.fire({
              icon: "success",
              title: "Success",
              text:res.message,
              showConfirmButton: false,
              timer: 1000
            });

            setTimeout(function () {
              location.reload();
            },1500);
          }
        }).catch(error => {
           Swal.fire({
              icon: "error",
              title: "Failed to delete review...",
              text: error,
            });
        })
      },
      confirmDelete(reviewId,productId){
        Swal.fire({
          title:'Are you sure you want to delete the review?',
          text:'Deleted reviews cannot be restored',
          icon:'warning',
          showCancelButton:true,
          confirmButtonColor:'#3085d6',
          confirmButtonText:'Ya'
        }).then((result) => {
            if(result.isConfirmed){
              this.deleteReview(reviewId,productId);
            }
        });
      }
    }
  });
</script>
@endpush

