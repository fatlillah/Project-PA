<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
    $style = '
    <style>
        /* Hapus margin agar gaya CSS berlaku dengan benar */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Calibri, sans-serif;
        }
        /* Mengatur lebar halaman pada mode cetak */
        @media print {
            @page {
                margin: 0;
                size: ';
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm;' : '75mm;';
    $style .= '}
        }
        .container {
            width: 300px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        #judul-kolom {
            font-weight: bold;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
        @media print {
            @page {
                margin: 5mm;
                size: 75mm 
                ';
                ?>
    <?php 
     $style .= 
        ! empty($_COOKIE['innerHeight'])
            ? $_COOKIE['innerHeight'] .'mm; }'
            : '}';
    ?>
      <?php
      $style .= '
              html, body {
                  width: 70mm;
              }
              .btn-print {
                  display: none;
              }
          }
      </style>
      ';
      ?>
        {!! $style !!}
</head>
<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            <h2>Butik RESAARE</h2>
            <p>Jl. KH. Wahid Hasyim Baratnya Resto Amanish
            </p>
            <small>IG: @resa_are WA: +62 819 1809 6923</small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul id="judul-kolom">
                    <li>No Order :</li>
                    <li>Kasir :</li>
                    <li>Tanggal :</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> No. Order</li>
                    <li> {{ $sales->user->name }} </li>
                    <li> {{ date('d M Y : H:i:s', strtotime($sales->created_at)) }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div id="judul-kolom" class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Produk</div>
            <div>Harga/Qty</div>
            <div>Disc %</div>
            <div>Total</div>
        </div>
        @foreach ($detail as $item)
            <div class="flex-container" style="text-align: right;">
                @php
                    if(!empty($item->product->name)) {
                        $arr_name = explode(' ', $item->product->name);
                        $name = $arr_name[0];
                    } elseif ($item->product->name != '') {
                            $name = $item->product->name;
                    } else {
                        $name = 'there';
                    }
                @endphp
                <div style="text-align: left;">{{ $item->amount }}x {{ $item->product->name }}</div>
                <div>{{ format_of_money($item->selling_price) }} </div>
                <div>{{ $item->discount }}% </div>
                <div>{{ format_of_money($item->subtotal) }} </div>
            </div>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul id="judul-kolom">
                    <li>Grand Total :</li>
                    <li>Pembayaran :</li>
                    <li>Kembalian :</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>{{ format_of_money($sales->total_price) }} </li>
                    <li>{{ format_of_money($sales->accepted) }}</li>
                    <li>{{ format_of_money($sales->accepted - $sales->pay) }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 20px;">
            <h3>-- TERIMA KASIH --</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
     <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>
