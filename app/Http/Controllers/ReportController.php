<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Production_cost;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start_date = date('Y-m-01');
        $last_date = date('Y-m-d');

        if ($request->has('start_date') && $request->has('last_date')) {
            $start_date = $request->start_date;
            $last_date = $request->last_date;
        }

        return view('admin.report.index', compact('start_date', 'last_date'));
    }

    public function getData($start_date, $last_date)
    {
        $no = 1;
        $data = array();
        $income = 0;
        $total_income = 0;

        while (strtotime($start_date) <= strtotime($last_date)) {
            $date = $start_date;
            $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));

            $total_sales = Sale::where('created_at', 'LIKE', "%$date%")->sum('pay');
            $total_production_cost = Production_cost::where('created_at', 'LIKE', "%$date%")->sum('grand_total');
            $total_expenditure = Expenditure::where('created_at', 'LIKE', "%$date%")->sum('nominal');

            $income = $total_sales - $total_production_cost - $total_expenditure;
            $total_income += $income;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['date'] = indonesian_date($date, false);
            $row['sales'] = format_of_money($total_sales);
            $row['production_cost'] = format_of_money($total_production_cost);
            $row['expenditure'] = format_of_money($total_expenditure);
            $row['income'] = format_of_money($income);

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex' => '',
            'date' => '',
            'sales' => '',
            'production_cost' => '',
            'expenditure' => 'Total Pendapatan',
            'income' => format_of_money($total_income),
        ];

        return $data;
    }

    public function data(Request $request)
    {
        $start_date = $request->start_date;
        $last_date = $request->last_date;

        $data = $this->getData($start_date, $last_date);

        return datatables()
            ->of($data)
            ->make(true);
    }

    public function exportPDF($start_date, $last_date)
    {
        $data = $this->getData($start_date, $last_date);
        $pdf  = Pdf::loadView('admin.report.pdf', compact('start_date', 'last_date', 'data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-pendapatan-' . date('d-m-Y') . '-Butik-ResaAre.pdf');
    }
}
