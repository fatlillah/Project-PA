@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Biaya Produksi
    </div>
</div>
@endsection

@push('css')
    <style>
        .show-grand-total{
            font-size: 5em;
            text-align: center;
            height: 100px;
            color: #ffffff;
        }
        .perform-fairly{
           padding: 10px;
           background: #f0f0f0;
           font-size: 1.2em; 
        }
        .table-production tbody tr:last-child {
            display: none;
        }

        @media(max-width: 768px){
            .show-grand-total{
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card mt-3">
            <div class="card-header">
                <label class="label label-primary">{{ $prod_themes->name }}</label>
                <span class="float-end">
                    <strong>{{ indonesian_date(now(), false) }}</strong> 
                </span> 
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <h6>User:</h6>
                        <div> <strong>{{ auth()->user()->name }}</strong> </div>
                        <div>{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <form id="form-product">
                    @csrf
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="hidden" name="production_id" id="production_id" value="{{ $production_id }}">
                                <input type="hidden" name="product_id" id="product_id">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk">
                                <button class="btn btn-primary" onclick="productShow()" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-striped table-production">
                    <thead>
                        <tr>
                            <th class="center">No.</th>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th class="right">Harga Bersih</th>
                            <th class="center">Harga Jual</th>
                            <th class="right">Subtotal</th>
                            <th width="12%"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                </table>
                <form action="{{ route('produksi.store') }}" id="form-production" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-lg-15 ">
                                <div class="perform-fairly"><strong>TOTAL</strong></div>    
                                <div class="show-grand-total bg-primary" id="grand_totalRp"></div>    
                            </div>
                            <div class="col-lg-4 col-sm-5 ms-auto">
                                <input type="hidden" name="production_id" value="{{ $production_id }}">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="grand_total" id="grand_total">
                                </div>
                            </div>
                    </form>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-submit" type="button">Simpan Transaksi</button>
                    </div>
                </div>
        </div>
    </div>
</div>


@include('admin.production-cost-detail.modal-product')
@endsection
@include('admin.production-cost-detail.script')
