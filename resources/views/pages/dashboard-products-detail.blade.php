@extends('layouts.dashboard')

@section('title')
    Store Dashboard - Product Detail
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $product['name'] }}</h2>
            <p class="dashboard-subtitle">
                Detail Produk
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $product->name ?? '-' }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" name="price" class="form-control"
                                                value="{{ $product->price ?? '-' }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="categories_id" class="form-control">
                                                <option value="{{ $product->categories_id }}">
                                                    {{ $product->category->name }}
                                                </option>
                                                @foreach ($categories as $category)
                                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description"
                                                id="editor">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5 btn-block">
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                               @foreach ($product->galleries as $gallery)
                                    <div class="col-md-4">
                                        <div class="gallery-container">
                                            <img src="{{url("storage/assets/products/".$gallery->photos)}}" alt="" class="w-100" />
                                            <a href="{{route('dashboard.products-gallery-delete', $gallery->id)}}"
                                                class="delete-gallery"
                                                onclick="event.preventDefault(); this.nextElementSibling.submit();">
                                                <img src="{{url('/images/icon-delete.svg')}}" alt="" />
                                            </a>
                                            <form action="{{ route('dashboard.products-gallery-delete', $gallery->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <form action="{{route('dashboard.products-gallery-upload')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="products_id">
                                        <input type="file" name="photos" id="file" style="display: none;" multiple
                                            onchange="form.submit()" />
                                        <button type="button" class="btn btn-secondary btn-block mt-3"
                                            onclick="thisFileUpload()">
                                            Add Photo
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("addon-script")
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
function thisFileUpload() {
    document.getElementById("file").click();
}

CKEDITOR.replace("editor");
</script>
@endpush