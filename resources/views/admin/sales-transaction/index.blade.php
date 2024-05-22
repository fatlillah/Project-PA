@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Transaksi Penjualan
    </div>
</div>
@endsection

@push('css')
    <style>
        .show-pay{
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
        .table-transaction tbody tr:last-child {
            display: none;
        }

        @media(max-width: 768px){
            .show-pay{
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
            <div class="card-header"> <label class="label label-primary">{{ $sales->no_order }}</label>
                <strong>{{ indonesian_date(now(), false) }}</strong> 
            </div>
            <div class="card-body">
                <form id="form-product">
                    @csrf
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="hidden" name="sale_id" id="sale_id" value="{{ $sale_id }}">
                                <input type="hidden" name="product_id" id="product_id">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk">
                                <button class="btn btn-primary" onclick="productShow()" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-striped table-transaction">
                    <thead>
                        <tr>
                            <th width="10%">No.</th>
                            <th width="15%">Nama</th>
                            <th width="11%">Qty</th>
                            <th width="15%">Harga</th>
                            <th width="15%">Diskon</th>
                            <th width="15%">Subtotal</th>
                            <th width="12%"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                </table>
                <form action="{{ route('transaksi-penjualan.save') }}" id="form-transaction" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="perform-fairly"></div>    
                                <div class="show-pay bg-primary"></div>    
                            </div>
                            <div class="col-lg-4">
                                <input type="hidden" name="sale_id" value="{{ $sale_id }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><label for="totalRp"><strong>Total</strong></label></td>
                                            <td class="right">
                                                <input type="text" class="form-control" id="totalRp" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><label for="accepted">Pembayaran</label></td>
                                            <td class="right">
                                                <input type="number" class="form-control" id="accepted" name="accepted" name="accepted" value="{{ $sales->accepted ?? 0 }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><label for="money_changes"><strong>Kembalian</strong></label></td>
                                            <td class="right">
                                                <input type="text" class="form-control" id="money_changes" name="money_changes" value="0" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-submit" type="button">Simpan Transaksi</button>
                        </div>
                    </form> 
                </div>
        </div>
    </div>
</div>


@include('admin.sales-transaction.modal-product')
@endsection
@include('admin.sales-transaction.script')
