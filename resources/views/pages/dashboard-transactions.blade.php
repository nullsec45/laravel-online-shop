@extends('layouts.dashboard')

@section('title')
    Dashboard Transaction
@endsection
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Transactions</h2>
            <p class="dashboard-subtitle">
                Big result start from the small one
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12 mt-2">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">Sell Product</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Buy Product</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            @forelse ($sellTransactions as $transaction)
                                <a href="{{ route('dashboard.transactions.show', $transaction->id) }}" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{ asset('storage/assets/products/'.$transaction->product->galleries->first()->photos ?? '') }}"
                                                    class="w-50" />
                                            </div>
                                            <div class="col-md-4">
                                                {{ $transaction->product->name }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $transaction->product->user->store_name }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $transaction->created_at }}
                                            </div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4>Tidak Ada Transaksi</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                           @forelse ($buyTransactions as $transaction)
                                <a href="{{ route('dashboard.transactions.show', $transaction->id) }}" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{ asset('storage/assets/products/'.$transaction->product->galleries->first()->photos ?? '') }}"
                                                    class="w-50" />
                                            </div>
                                            <div class="col-md-4">
                                                {{ $transaction->product->name}}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $transaction->product->user->store_name }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $transaction->created_at }}
                                            </div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4>Tidak Ada Transaksi</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
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