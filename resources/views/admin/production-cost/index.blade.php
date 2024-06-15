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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group mb-1">
                    <a onclick="addForm()" class="btn btn-primary light px-3"><i class="fa fa-plus-circle"></i> Produksi Baru</a>
                    @if(session()->has('production_id'))
                    <a href="{{ route('produksi-detail.index') }}" class="btn btn-warning light px-3"><i class="fa fa-pencil-alt"></i> Transaksi Aktif</a>
                    @endif
                </div>
                <div class="btn-group mb-1">
                    <a href="{{ url('tema-produksi') }}" class="btn btn-primary light px-3"><i class="fa fa-plus-circle"></i> Tema Produksi</a>
                </div>                
            </div>            
            <div class="card-body">
                <div class="table-responsive">
                        <table id="example4" class="display table-production-cost" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Tema Produksi</th>
                                    <th>User</th>
                                    <th>Total Item</th>
                                    <th>Grand Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.production-cost.modal-prod-themes')
@include('admin.production-cost.modal-detail')
@endsection
@include('admin.production-cost.script')
