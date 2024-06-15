@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Data Pembayaran
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Pesanan</th>
                                <th>Jumlah Tagihan</th>
                                <th>Terbayar</th>
                                <th>Sisa Tagihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php
                        $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($creditPay as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->credit->creditOrder->order->customer->name }}</td>
                                <td>{{ $item->credit->creditOrder->order->total_item }}</td>
                                <td>{{ format_of_money($item->credit->creditOrder->price) }}</td>
                                <td>{{ format_of_money($item->paid) }}</td>
                                <td>{{ format_of_money($item->remaining_bill) }}</td>
                                <td width="18%">
                                    <a href="{{ route('pembayaran-kredit-detail.show', $item->id) }}" class="btn btn-primary light px-3">
                                        <i class="fa fa-eye"></i> Lihat Pembayaran
                                    </a>
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