<?php

namespace App\Http\Controllers;

use App\Models\Credit_payment;
use App\Models\Expenditure;
use App\Models\Order;
use App\Models\Product;
use App\Models\Production_cost;
use App\Models\Production_cost_detail;
use App\Models\Sale;
use App\Models\Sale_detail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::sum('stock');

        $startDate = date('Y-m-01');
        $lastDate = date('Y-m-d');

        $dateData = array();
        $incomeDataDaily = array();
        $incomeDataMonthly = array();
        $incomeDataYearly = array();

        $todayIncome = 0;
        $totalIncome = 0;

        // Loop for daily income
        while (strtotime($startDate) <= strtotime($lastDate)) {
            $dateData['daily'][] = (int) substr($startDate, 8, 2);

            $totalSale = Sale::where('created_at', 'LIKE', "%$startDate%")->sum('pay');
            $totalProductionCost = Production_cost::where('created_at', 'LIKE', "%$startDate%")->sum('grand_total');
            $totalExpenditure = Expenditure::where('created_at', 'LIKE', "%$startDate%")->sum('nominal');
            $totalCredit = Credit_payment::where('created_at', 'LIKE', "%$startDate%")->sum('paid');

            $income = $totalSale + $totalCredit - $totalProductionCost - $totalExpenditure;
            $incomeDataDaily[] = $income;

            if ($startDate === date('Y-m-d')) {
                $todayIncome = $income;
            }

            $totalIncome += $income;

            $startDate = date('Y-m-d', strtotime("+1 day", strtotime($startDate)));
        }

        // Loop for monthly income
        $startDate = date('Y-01-01');
        while (strtotime($startDate) <= strtotime($lastDate)) {
            $monthYear = date('Y-m', strtotime($startDate));
            $dateData['monthly'][] = date('M', strtotime($startDate));

            $totalSale = Sale::where('created_at', 'LIKE', "%$monthYear%")->sum('pay');
            $totalProductionCost = Production_cost::where('created_at', 'LIKE', "%$monthYear%")->sum('grand_total');
            $totalExpenditure = Expenditure::where('created_at', 'LIKE', "%$monthYear%")->sum('nominal');
            $totalCredit = Credit_payment::where('created_at', 'LIKE', "%$monthYear%")->sum('paid');

            $income = $totalSale + $totalCredit - $totalProductionCost - $totalExpenditure;
            $incomeDataMonthly[] = $income;

            $startDate = date('Y-m-d', strtotime("$startDate +1 month"));
        }

        // Yearly income
        $startDate = date('Y-01-01');
        while (strtotime($startDate) <= strtotime($lastDate)) {
            $year = date('Y', strtotime($startDate));
            $dateData['yearly'][] = $year;

            $totalSale = Sale::where('created_at', 'LIKE', "%$year%")->sum('pay');
            $totalProductionCost = Production_cost::where('created_at', 'LIKE', "%$year%")->sum('grand_total');
            $totalExpenditure = Expenditure::where('created_at', 'LIKE', "%$year%")->sum('nominal');
            $totalCredit = Credit_payment::where('created_at', 'LIKE', "%$year%")->sum('paid');

            $income = $totalSale + $totalCredit - $totalProductionCost - $totalExpenditure;
            $incomeDataYearly[] = $income;

            $startDate = date('Y-m-d', strtotime("$startDate +1 year"));
        }

        $startDate = date('Y-m-01');

        // Top selling products
        $productSales = Sale_detail::with('product')
            ->selectRaw('product_id, SUM(amount) as total_sold')
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->take(3)
            ->get();

        $pendingOrders = Order::whereHas('customer', function ($query) {
            $query->where('name', '!=', '-');
        })->paginate(3);

        if ($request->ajax()) {
            return view('layouts.pagination.table-order', compact('pendingOrders'))->render();
        }

        return view('dashboard', compact(
            'products',
            'dateData',
            'incomeDataDaily',
            'incomeDataMonthly',
            'incomeDataYearly',
            'todayIncome',
            'totalIncome',
            'startDate',
            'lastDate',
            'productSales',
            'pendingOrders'
        ));
    }
}
