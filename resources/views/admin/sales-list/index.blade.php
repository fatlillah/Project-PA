@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Daftar Penjualan
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">            
            <div class="card-body">
                <div class="table-responsive">
                        <table id="example4" class="display table-sales-list" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Total Bayar</th>
                                    <th>Kasir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.sales-list.modal-detail')
@endsection
@include('admin.sales-list.script')
