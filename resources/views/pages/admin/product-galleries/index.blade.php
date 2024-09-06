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
                List of Galleries
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid">
                             <a href="{{route('admin.product-galleries.create')}}" class="btn btn-primary float-right mb-4">Add Photo</a>
                            </div>
                            <div class="table table-responsive mt-4">
                                <table class="table-hover scroll-horizontal-vertical w-100 mt-4" id="table-products">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Photo</th>
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
                {data:"product.name", name:"product.name"},
                {data:"photos", name:"photos"},
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