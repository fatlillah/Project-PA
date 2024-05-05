@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Pengeluaran
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" onclick="addForm('{{ route('pengeluaran.store') }}')" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Pengeluaran</button>
            </div>
                 <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                @if (auth()->user()->hasRole('admin'))
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.expenditure.form')
@endsection
@include('admin.expenditure.script')