@extends('layouts.apps')
@push('css')
<link rel="stylesheet" href="{{ url('assets/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/pickadate/themes/default.date.css') }}">
	<link href="../icon.css?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/custom-pickadate.css') }}">
@endpush
@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Transaksi Pemesanan
    </div>
</div>
@endsection

@section('content')
<form action="{{ route('transaksi-pemesanan.store') }}" id="form-transaction" method="post">
    @csrf
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Order Form</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}">
                <input type="hidden" name="total_item" id="total_item">
                <div class="row">
                    <div class="col-xl-3 mb-3">
                        <div class="example">
                            <p class="mb-1">Nama Pemesan</p>
                            <input type="text" name="name_order" id="name_order" class="form-control @error('name_order') is-invalid @enderror">
                            @error('name_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-3 mb-3">
                        <div class="example">
                            <p class="mb-1">No. HP</p>
                            <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="example">
                            <p class="mb-1"><strong>Uang Muka (DP)</strong></p>
                            <input type="number" name="DP" id="DP" class="form-control @error('DP') is-invalid @enderror">
                            @error('DP')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-3 mb-3">
                        <div class="example">
                            <p class="mb-1">Metode Pembayaran</p>
                            <input type="text" name="credit" id="credit" class="form-control @error('credit') is-invalid @enderror">
                            @error('credit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header"> 
                    <button type="button" onclick="addForm('{{ route('ukuran-detail-pesanan.store') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah ukuran</button>
                    
                    <div class="row mb-2">
                        <label for="deadline" class="col-sm-3 col-form-label" style="white-space: nowrap;"><strong>Deadline</strong></label>
                        <div class="col-sm-9">
                            <input type="text" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror">
                            @error('deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-transaction">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th width="15%">Nama Produk</th>
                                <th width="11%">Qty</th>
                                <th width="12%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-submit" type="button" style="float: right">Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin.orders-transaction.form-detail-size')
@endsection
@include('admin.orders-transaction.script')
@push('scripts')
    
<script src="{{ url('assets/vendor/pickadate/picker.js') }}"></script>
<script src="{{ url('assets/vendor/pickadate/picker.time.js') }}"></script>
<script src="{{ url('assets/vendor/pickadate/picker.date.js') }}"></script>
<script src="{{ url('assets/js/plugins-init/pickadate-init.js') }}"></script>
@endpush