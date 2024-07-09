<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran Kredit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 50%; /* Set a maximum width as a percentage of the container */
            max-height: 150px; /* Set a maximum height in pixels */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 10px;
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
<body onload="window.print()">
    <div class="header">
        <img src="{{ url('assets/images/logo-resaare.png') }}" alt="Logo">
        <h2>Nota Pembayaran</h2>
        <p>Terima Kasih atas Pemesanan Anda!</p>
    </div>
    <div class="table-container">
        <div class="flex-container">
            <div>
                <p>Nama Pelanggan: {{ $order->customer->name }}</p>
            </div>
            <div style="text-align: right;">
                <p>No. Order: {{ $order->no_order }}</p>
            </div>
        </div>
        <hr>
        <h4>List Pesanan:</h4>
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
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
<h4>Pembayaran Tagihan:</h4>
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Bulan</th>
            <th>Angsuran</th>
            <th>Tagihan</th>
            <th>Status</th>
            <th>Tanggal Bayar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($creditPayDetail as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ indonesian_date($item->month, 'month_year') }}</td>
            <td>Angsuran ke-{{ $item->no_credit }}</td>
            <td>{{ format_of_money($item->bill) }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ indonesian_date($item->updated_at, 'date_month_year') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
        <div class="footer">
            <h3>-- TERIMA KASIH --</h3>
        </div>
    </div>
</body>
</html>



