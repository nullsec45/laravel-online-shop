@extends('layouts.dashboard')

@section('title')
    Edit Product
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Products</h2>
            <p class="dashboard-subtitle">
                Edit Product
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
                           <form action="{{route('admin.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                                @method("PUT")
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="name" 
                                                   id="product_name" 
                                                   class="form-control" value="{{$product->name}}" 
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="users_id">Product Owner</label>
                                             <select name="users_id" id="users_id" class="form-control">
                                                @foreach ($users as $user )
                                                    <option value="{{$user->id}}" {{$user->id == $product->user_id ? "selected" : ""}}>
                                                        {{$user->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categories_id">Product Category</label>
                                             <select name="categories_id" id="categories_id" class="form-control">
                                                @foreach ($categories as $category )
                                                    <option value="{{$category->id}}" {{$category->id == $product->category_id ? "selected" : ""}}>
                                                        {{$category->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" 
                                                   id="price" 
                                                   class="form-control"
                                                    value="{{(int)$product->price}}"                        
                                            required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="editor">Product Description</label>
                                            <textarea name="description" id="editor" class="form-control" cols="3" rows="3">
                                                {!!$product->description!!} 
                                            </textarea>
                                        </div>
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
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace("editor");
</script>
@endpush