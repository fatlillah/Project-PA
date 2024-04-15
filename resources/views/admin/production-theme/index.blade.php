@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Tema Produk
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="clearfix mb-3">
                    <a href="javascript:history.back()" class="btn btn-primary px-3 my-1 light me-2"><i class="fa fa-arrow-left"></i> </a>
                    <a onclick="addForm('{{ route('tema-produksi.store') }}')" class="btn btn-primary px-3 my-1 me-2"><i class="fa fa-plus-circle"></i> Tambah Tema Produksi</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tema Produksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.production-theme.form')
@endsection
@include('admin.production-theme.script')