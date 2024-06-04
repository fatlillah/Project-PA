<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .invoice-container {
            background-color: #fff;
            padding: 20px;
            max-width: 600px; /* Lebar tabel disesuaikan */
            margin: auto;
            border: 1px solid #ddd;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            height: 100px;
        }

        .store-info {
            margin-left: 0px; /* Reduced margin to decrease the distance */
        }
        .store-info p, .store-info h2{
            margin: 0;
        }

        .order-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .order-info-left p, .order-info-right p {
            margin: 4px 0;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .product-table th {
            background-color: #f2f2f2;
        }

        .product-table ul {
            list-style: disc;
            padding-left: 20px; /* Disesuaikan dengan lebar tabel */
            margin: 0;
            display: grid;
            grid-template-columns: 250px 1fr;
            row-gap: 1px;
        }

        .product-title {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .product-details li {
            margin-left: 7px;
        }

        .product-details li span {
            margin-left: 10px;
            display: contents
        }

        .payment-info {
            margin-top: 20px;
            text-align: right;
        }

        .payment-info p {
            margin: 1px;
        }

        .notes {
            margin-top: 20px;
        }

        .notes p {
            margin: 0;
        }

    </style>
</head>
<body>
<div class="invoice-container">
    <div class="header">
        <div class="logo">
            <img src="{{ url('assets/images/logo-resaare.png') }}"  alt="Logo" />
        </div>
        <div class="store-info">
            <h2>ResaAre</h2>
            <p>Jl. KH. Wahid Hasyim Baratnya Resto Amanish</p>
            <p>WA: +62 819 1809 6923 IG: @resa_are</p>
        </div>
    </div>
    <div class="order-details">
        <div class="order-info-left">
            <p><strong>Nama Pemesan:</strong> {{ $orders->name_order }}</p>
            <p><strong>No. Telp:</strong> {{ $orders->phone }}</p>
            <p><strong>Deadline:</strong> {{ $orders->deadline }}</p>
        </div>
        <div class="order-info-right">
            <p><strong>Tanggal:</strong> {{ indonesian_date($orders->created_at, false) }}</p>
            <p><strong>No. Order:</strong> {{ $orders->no_order }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $orders->credit }}</p>
        </div>
    </div>
    <table class="product-table">
        <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Jumlah</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($orderDetail as $key => $item)
        <tr>
            <td>
                <strong class="product-title">{{ $item->detail_size->name_product }}</strong>
                <ul class="product-details">
                    <li>Lingkar Badan: <span>{{ $item->detail_size->body }} cm</span></li>
                    <li>Lingkar Pinggang: <span>{{ $item->detail_size->waist }} cm</span></li>
                    <li>Lingkar Panggul: <span>{{ $item->detail_size->pelvis }} cm</span></li>
                    <li>Lingkar Armhole: <span>{{ $item->detail_size->armhole }} cm</span></li>
                    <li>Panjang Bahu: <span>{{ $item->detail_size->length_shoulder }} cm</span></li>
                    <li>Panjang Lengan: <span>{{ $item->detail_size->arm_length }} cm</span></li>
                    <li>Panjang Baju: <span>{{ $item->detail_size->length_shirt }} cm</span></li>
                    <li>Panjang Muka: <span>{{ $item->detail_size->length_face }} cm</span></li>
                </ul>
            </td>
            <td>{{ $item->amount }}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td ><strong style="float: right">Down Payment (DP)</strong></td>
            <td>{{ format_of_money($orders->DP) }}</td>
        </tr>
        </tfoot>
    </table>
    <div class="payment-info">
        <p><strong>Transfer payment method:</strong></p>
        <p>a.n DWI FATILLAH</p>
        <p>Mandiri - 1400864346789</p>
    </div>
    <div class="notes">
        <p><strong>Notes:</strong></p>
        <p>Terimakasih sudah melakukan pemesanan desain custom di ResaAre</p>
    </div>
</div>
</body>
</html>