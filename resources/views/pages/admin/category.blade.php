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
                List of Categories
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('categories.create')}}" class="btn btn-primary">Add Category</a>
                        </div>
                        <div class="table table-responsive">
                            <table class="table-hover scroll-horizontal-vertical w-100 mt-4" id="table-categories">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Foto</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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