@extends('layouts.dashboard')

@section('title')
    Categories Dashboard
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Categories</h2>
            <p class="dashboard-subtitle">
                Create New Category
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
                           <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Category Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Image Category</label>
                                            <input type="file" name="photo" class="form-control" required>
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
    <script>
        let datatable=$("#table-categories").DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:{
                url:"{!! url()->current() !!}"
            },
            columns:[
                {data:"id", name:"id"},
                {data:"name", name:"name"},
                {data:"photo", name:"photo"},
                {data:"slug", name:"slug"},
                {
                 data:"actions", 
                 name:"actions", 
                 orderable:false,
                 searchable:false, 
                 width:"15%",
                 render: function (data, type, row, meta){
                    return data;
                 }
                },
            ]
        });
    </script>
@endpush