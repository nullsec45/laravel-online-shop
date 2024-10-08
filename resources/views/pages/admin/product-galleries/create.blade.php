@extends('layouts.dashboard')

@section('title')
    Product Galleries
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Product Galleries</h2>
            <p class="dashboard-subtitle">
                Upload Image Product
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div> 
                    @endif
                    <div class="card">
                        <div class="card-body">
                           <form action="{{route('admin.product-galleries.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="products_id">Products</label>
                                             <select name="products_id" id="products_id" class="form-control">
                                                @foreach ($products as $product )
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="photos">Photo Product</label>
                                            <input type="file" name="photos" id="photos" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                  <div class="row d-none" id="imagePreviewContainer">
                                    <div class="col-md-12">
                                        <h6>Preview Image</h6>
                                        <figure>
                                            <img src="" 
                                                class="img-fluid" 
                                                alt="" id="imagePreview" width="30%">
                                            <figcaption id="imageCaption">
                                               
                                            </figcaption>
                                        </figure> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
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
@endsection

@push('addon-script')
<script>
    document.getElementById("photos").addEventListener("change", function(event){
        const file=event.target.files[0];
        const fileVal=this.value;
        console.log(fileVal);
        if(file || fileVal){
            document.getElementById("imagePreviewContainer").classList.remove("d-none");
            const reader=new FileReader();
            reader.onload=function(e){
                document.getElementById("imagePreview").src=e.target.result;
                document.getElementById("imageCaption").textContent=file.name
            }
               reader.readAsDataURL(file);
        }else{
            document.getElementById("imagePreviewContainer").classList.add("d-none");
        }
    });
</script>
@endpush