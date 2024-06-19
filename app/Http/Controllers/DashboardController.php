<?php

namespace App\Http\Controllers;

use App\Models\Credit_payment;
use App\Models\Expenditure;
use App\Models\Order;
use App\Models\Product;
use App\Models\Production_cost;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::sum('stock');
        $orders = Order::whereHas('customer', function ($query) {
            $query->where('name', '!=', '-');
        })->count();

        $startDate = date('Y-m-01');
        $lastDate = date('Y-m-d');

        $dateData = array();
        $incomeData = array();
        $todayIncome = 0;
        $totalIncome = 0;

        while (strtotime($startDate) <= strtotime($lastDate)) {
            $dateData[] = (int) substr($startDate, 8, 2);

            $totalSale = Sale::where('created_at', 'LIKE', "%$startDate%")->sum('pay');
            $totalProductionCost = Production_cost::where('created_at', 'LIKE', "%$startDate%")->sum('grand_total');
            $totalExpenditure = Expenditure::where('created_at', 'LIKE', "%$startDate%")->sum('nominal');
            $totalCredit = Credit_payment::where('created_at', 'LIKE', "%$startDate%")->sum('paid');

            $income = $totalSale + $totalCredit - $totalProductionCost - $totalExpenditure;
            $incomeData[] = $income;

            if ($startDate === date('Y-m-d')) {
                $todayIncome = $income;
            }

            $totalIncome += $income;

            $startDate = date('Y-m-d', strtotime("+1 day", strtotime($startDate)));
        }

        $startDate = date('Y-m-01');
        return view('dashboard', compact('products', 'orders', 'dateData', 'incomeData', 'todayIncome', 'totalIncome', 'startDate', 'lastDate'));
    }
}
