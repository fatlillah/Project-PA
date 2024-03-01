@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Produk
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" onclick="addForm('{{ route('produk.store') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Produk</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Produk</th>
                                <th>Kategori</th>
                                <th>Nama Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.product.form')
@endsection
@include('admin.product.script')