@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Pembayaran Detail
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">List Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table class="table table-bordered verticle-middle">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%">No.</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col" style="width: 15%">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->detail_size->name_product }}</td>
                                <td>{{ $item->amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Informasi Pelanggan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 mb-3">
                                <div class="example">
                                    <p class="mb-1">Nama Pelanggan</p>
                                    <input style="background: #EEEEEE" type="text" class="form-control" value="{{ $order->customer->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="example">
                                    <p class="mb-1">Jumlah Tagihan</p>
                                    <input type="text" style="background: #EEEEEE" class="form-control" value="{{ format_of_money($creditOrder->price) }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Pembayaran Tagihan</h6>
                 <button class="btn btn-warning btn-sm print-all" data-url="{{ route('pembayaran-kredit-detail.printAll', $creditPayment->id) }}">
                    <i class="fa fa-print"></i> Cetak Semua
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Bulan</th>
                                <th>Angsuran</th>
                                <th>Tagihan</th>
                                <th>Status</th>
                                <th>Jatuh Tempo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($creditPayDetail as $item)
                            <tr data-id="{{ $item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td class="{{ $item->status === 'Belum bayar' ? 'text-danger' : 'text-dark' }}">{{ indonesian_date($item->month, 'month_year') }}</td>
                                <td class="{{ $item->status === 'Belum bayar' ? 'text-danger' : 'text-dark' }}">Angsuran ke-{{ $item->no_credit }}</td>
                                <td class="{{ $item->status === 'Belum bayar' ? 'text-danger' : 'text-dark' }}">{{ format_of_money($item->bill) }}</td>
                                <td class="{{ $item->status === 'Belum bayar' ? 'text-danger' : 'text-dark' }}">{{ $item->status }}</td>
                                <td class="{{ $item->status === 'Belum bayar' ? 'text-danger' : 'text-dark' }}">{{ indonesian_date($item->pay_date, 'date_month_year') }}</td>
                                <td width="20%">
                                    @if ($item->status === 'Belum bayar')
                                        <button class="btn btn-primary btn-sm update-status" data-url="{{ route('pembayaran-kredit-detail.updateStatus', $item->id) }}">
                                            <i class="fas fa-money-bill-wave"></i> Bayar
                                        </button>
                                    @else
                                        <button class="btn btn-danger btn-sm cancel-payment sharp me-1" data-url="{{ route('pembayaran-kredit-detail.cancel', $item->id) }}">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                        <button class="btn btn-info btn-sm print-receipt" data-url="{{ route('pembayaran-kredit-detail.nota', $item->id) }}">
                                            <i class="fa fa-print"></i> Cetak
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('admin.credit.pay-detail.script')