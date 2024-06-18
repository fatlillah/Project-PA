<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nota Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 0;
        }

        .table-container {
            width: 100%;
            margin-bottom: 20px;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .flex-container div {
            width: 48%;
        }

        hr {
            margin: 10px 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .text-danger {
            color: red;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Nota Pembayaran</h2>
        <p>Terima Kasih atas Pembelian Anda!</p>
    </div>
    <div class="table-container">
        <div class="flex-container">
            <div>
                <p>Nama Pelanggan: {{ $order->customer->name }}</p>
                <p>Tanggal Pembelian: {{ $order->created_at->format('d-m-Y') }}</p>
            </div>
            <div style="text-align: right;">
                <p>No. Order: {{ $order->id }}</p>
            </div>
        </div>
        <hr>
        @if ($order->orderDetail->count() > 0)
        <div>
            <p><strong>Daftar Produk:</strong></p>
            <ul>
                @foreach ($order->orderDetail as $item)
                <li>{{ $item->detail_size->name_product }} - Jumlah: {{ $item->amount }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <hr>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Angsuran</th>
                    <th>Tagihan</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($creditPayDetail as $item)
                <tr class="{{ $item->status === 'Belum bayar' ? 'text-danger' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ indonesian_date($item->month, 'month_year') }}</td>
                    <td>Angsuran ke-{{ $item->no_credit }}</td>
                    <td>{{ format_of_money($item->bill) }}</td>
                    <td>{{ indonesian_date($item->pay_date, 'date_month_year') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <h3>-- TERIMA KASIH --</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
</body>

</html>