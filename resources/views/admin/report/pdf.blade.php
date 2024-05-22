<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan Butik ResaAre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        h2, p {
            text-align: center;
            margin: 5px 0; 
        }
        p {
            margin-bottom: 20px; 
        }
        hr {
            border: 0;
            height: 1px;
            background-color: #ccc; 
            margin-top: 20px; 
            margin-bottom: 20px; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .dark-column {
            background-color: #e0e0e0;
            color: #333;
			/* font-weight: bold; */
        }
    </style>
</head>
<body>
    <div class="container">
		<h2>Laporan Pendapatan</h2>
		<h2>Butik ResaAre</h2>
		<p>
            {{ indonesian_date($start_date, false) }}
            s/d
            {{ indonesian_date($last_date, false) }}
		</p>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th width="18%">Tanggal</th>
                    <th>Penjualan Bersih</th>
                    <th>Penjualan</th>
                    <th>Pengeluaran</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($data as $row) {
                ?>
                <tr>
                    <td><?= $row['DT_RowIndex'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['sales'] ?></td>
                    <td><?= $row['production_cost'] ?></td>
                    <td><?= $row['expenditure'] ?></td>
                    <td class="dark-column"><?= $row['income'] ?></td>
                </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
