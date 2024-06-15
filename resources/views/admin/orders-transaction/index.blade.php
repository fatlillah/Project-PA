@extends('layouts.apps')
@push('css')
<link rel="stylesheet" href="{{ url('assets/vendor/pickadate/themes/default.css') }}">
<link rel="stylesheet" href="{{ url('assets/vendor/pickadate/themes/default.date.css') }}">
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
<form action="{{ route('transaksi-pemesanan.save') }}" id="form-transaction" method="post">
    @csrf
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Form</h4>
                </div>
                <div class="card-body">
                    <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}">
                    <input type="hidden" name="total_item" id="total_item">
                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <div class="example">
                                <p class="mb-1">Nama Pemesan</p>
                                <div class="input-group">
                                    <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                                        <option selected="" disabled>Pilih Nama Pemesan</option>
                                        @foreach($customers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-outline-primary" onclick="addCustomer('{{ route('pelanggan.store') }}')" type="button" id="button-addon2">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="example">
                                <p class="mb-1">Uang Muka (DP)</p>
                                <input type="number" name="DP" id="DP" class="form-control @error('DP') is-invalid @enderror" value="{{ $orders->DP ?? 0 }}">
                                @error('DP')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Collection Date</h4>
                </div>
                <div class="card-body">
                    <p class="mb-1">Deadline</p>
                    <input type="text" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror">
                    @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Card -->
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card mt-3">
            <div class="card-header"> 
                <button type="button" onclick="addForm('{{ route('ukuran-detail-pesanan.store') }}')" class="btn btn-primary mb-2">
                    <i class="fa fa-plus-circle"></i> Tambah ukuran
                </button>
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
</form>

@include('admin.orders-transaction.form-detail-size')
@include('admin.customer.form')
@endsection

@include('admin.orders-transaction.script')
@include('admin.customer.script')

@push('scripts')
<script src="{{ url('assets/vendor/pickadate/picker.js') }}"></script>
<script src="{{ url('assets/vendor/pickadate/picker.time.js') }}"></script>
<script src="{{ url('assets/vendor/pickadate/picker.date.js') }}"></script>
<script src="{{ url('assets/js/plugins-init/pickadate-init.js') }}"></script>
@endpush
