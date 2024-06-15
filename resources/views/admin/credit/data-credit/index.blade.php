@extends('layouts.apps')

@push('css')
    <link href="{{ url('assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Data Angsuran
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if (auth()->user()->hasRole('admin'))
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-primary light px-3" onclick="addForm('{{ route('data-kredit.store') }}')"><i class="fa fa-plus-circle"></i> Tambah Data Angsuran</button>
                </div>
                @endif
            </div>            
            <div class="card-body">
                <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th >Tanggal</th>
                                    <th style="width: 18%">Nama Pelanggan</th>
                                    <th style="width: 15%">Total Pesanan</th>
                                    <th style="width: 14%">Harga</th>
                                    <th style="width: 10%">Tenor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.credit.data-credit.form')
@endsection
@include('admin.credit.data-credit.script')
@push('scripts')
    <script src="{{ url('assets/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush