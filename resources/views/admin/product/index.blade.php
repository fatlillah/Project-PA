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
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-primary light px-3" onclick="addForm('{{ route('produk.store') }}')"><i class="fa fa-plus-circle"></i> Tambah Produk</button>
                    <button type="button" class="btn btn-primary light px-3" onclick="deleteSelected('{{ route('produk.delete_selected') }}')"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>            
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" class="form-product">
                        @csrf
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="form-check-input" name="checkAll" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </th>
                                    <th>No.</th>
                                    <th>Kode Produk</th>
                                    <th>Kategori</th>
                                    <th>Nama Produk</th>
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

@include('admin.product.form')
@endsection
@include('admin.product.script')