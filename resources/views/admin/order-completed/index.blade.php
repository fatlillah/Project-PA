@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Data Pesanan
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Pesanan</button>
            </div>
            <div class="card-body">
                <form id="form-order">
                    @csrf
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="hidden" name="completed_order_id" id="completed_order_id">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="display table-index" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Order</th>
                                <th>Nama Pemesan</th>
                                <th>Total Item</th>
                                <th width="17%">Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.order-completed.form')
@include('admin.order-completed.modal-order')
@endsection
@include('admin.order-completed.script')