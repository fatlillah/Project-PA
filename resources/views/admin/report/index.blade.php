@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Laporan Pendapatan
    </div>
</div>
@endsection

@push('css')
    <link href="{{ url('assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Laporan Pendapatan <h3 class="fc-toolbar-title">{{ indonesian_date($start_date, false) }} s/d {{ indonesian_date($last_date, false) }}</h3></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-xl-4 mb-3">
                    <div class="example">
                        <p class="mb-1">Periode</p>
                        <input class="form-control input-daterange-datepicker" type="text" id="daterange" name="daterange" value="{{ $start_date }} - {{ $last_date }}">
                    </div>
                </div>
                <div class="btn-group mb-1">
                    <a href="{{ route('laporan.export_pdf', [$start_date, $last_date]) }}" class="btn btn-danger light px-3"><i class="fa fa-file-pdf"></i> Export PDF</a>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th >Tanggal</th>
                                <th width="20%">Penjualan Bersih</th>
                                <th>Penjualan</th>
                                <th>Pengeluaran</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@include('admin.report.script')
@push('scripts')
    <script src="{{ url('assets/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush