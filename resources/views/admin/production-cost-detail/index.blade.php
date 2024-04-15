@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Biaya Produksi
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-5">
                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <h6>User:</h6>
                        <div> <strong>Admin</strong> </div>
                        <div>Email: areya@admin.com</div>
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
                <div class="table-responsive">
                    <table class="table table-striped">
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
                </div>
                {{-- <div class="row">
                    <div class="col-lg-4 col-sm-5"> </div>
                    <div class="col-lg-4 col-sm-5 ms-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left"><strong>Total</strong></td>
                                    <td class="right"><strong>$7.477,36</strong><br>
                                        <strong>0.15050000 BTC</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>


@include('admin.production-cost-detail.modal-product')
@endsection
@include('admin.production-cost-detail.script')
