@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Pembayaran Detail
    </div>
</div>
@endsection

@push('css')
<style>
    .show-pay {
        font-size: 5em;
        text-align: center;
        height: 100px;
        color: #ffffff;
    }
    .perform-fairly {
       padding: 10px;
       background: #f0f0f0;
       font-size: 1.2em; 
    }
    .table-transaction tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px){
        .show-pay {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

@section('content')
<form action="{{ route('pembayaran-cash.store') }}" id="form-payment" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header">
                    <label class="label label-primary">{{ $order->no_order }}</label>
                    <strong>{{ indonesian_date(now(), false) }}</strong>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                            <h6>Informasi Pelanggan:</h6>
                            <div><strong>{{ $order->customer->name }}</strong></div>
                            <div>{{ $order->customer->address }}</div>
                            <div>Phone: {{ $order->customer->phone }}</div>
                        </div>
                    </div>
                    <table class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="10%"><strong>No.</strong></th>
                                    <th width="15%"><strong>Nama Pemilik</strong></th>
                                    <th width="15%"><strong>Nama Produk</strong></th>
                                    <th width="11%"><strong>Qty</strong></th>
                                    <th width="9%"><strong>Diskon</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->detail_size->customer ?? '-' }}</td>
                                    <td>{{ $item->detail_size->name_product }}</td>
                                    <td>{{ $item->amount }} pcs</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" class="form-control input-sm disc" data-id="{{ $item->id }}" value="{{ $item->discount ?? 0 }}" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                            <span class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">%</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </table>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="perform-fairly"></div>
                            <div class="show-pay bg-primary"></div>
                        </div>
                        <div class="col-lg-4">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><label for="totalRp"><strong>Total</strong></label></td>
                                        <td class="right">
                                            <input type="text" class="form-control" id="totalRp" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left"><label for="accepted">Pembayaran</label></td>
                                        <td class="right">
                                            <input type="number" class="form-control" id="accepted" name="accepted" value="">
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
                        <button class="btn btn-primary btn-submit" type="button" style="float: right">Simpan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection