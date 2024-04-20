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
                    <a href="{{ url('tema-produksi') }}" class="btn btn-primary light px-3"><i class="fa fa-plus-circle"></i> Tema Produksi</a>
                </div>                
            </div>            
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" class="form-product">
                        @csrf
                        <table id="example4" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>User</th>
                                    <th>Total Item</th>
                                    <th>Grand Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.production-cost.modal-prod-themes')
@endsection
@include('admin.production-cost.script')
