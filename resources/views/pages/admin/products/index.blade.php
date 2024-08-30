@extends('layouts.dashboard')

@section('title')
    Products Dashboard
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Products</h2>
            <p class="dashboard-subtitle">
                List of Products
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid">
                             <a href="{{route('admin.products.create')}}" class="btn btn-primary float-right mb-4">Add Product</a>
                            </div>
                            <div class="table table-responsive mt-4">
                                <table class="table-hover scroll-horizontal-vertical w-100 mt-4" id="table-products">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Owner</th>
                                            <th>Category</th>
                                            <th>Price</th>
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
</div>
@endsection

@push('addon-script')
    <script>
        let datatable=$("#table-products").DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:{
                url:"{!! url()->current() !!}"
            },
            columns:[
                {data:"id", name:"id"},
                {data:"name", name:"name"},
                {data:"user.name", name:"user.name"},
                {data:"category.name", name:"category.name"},
                {data:"price", name:"price"},
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