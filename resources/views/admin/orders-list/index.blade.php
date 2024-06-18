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
                                    <th></th>
                                    <th>No.</th>
                                    <th>No. Order</th>
                                    <th>Tanggal</th>
                                    <th>Pelanggan</th>
                                    <th>Total Item</th>
                                    <th>Diambil</th>
                                    <th>DP</th>
                                    <th>Status</th>
                                    <th>Kasir</th>
                                    <th></th>
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
