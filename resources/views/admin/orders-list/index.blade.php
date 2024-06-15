@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Daftar Pemesanan
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">            
            <div class="card-body">
                <div class="table-responsive">
                        <table id="example4" class="display table-orders-list" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>No. Order</th>
                                    <th>Pemesan</th>
                                    <th>Total Item</th>
                                    <th>Tanggal Ambil</th>
                                    <th>DP</th>
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


@endsection
@include('admin.orders-list.script')
