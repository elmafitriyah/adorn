<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total penjualan hari ini
        $totalSalesToday = Transaction::whereDate('transaction_date', now())->count();
        
        // Total pendapatan hari ini
        $todayRevenue = Transaction::whereDate('transaction_date', Carbon::today())->sum('total_price');

        // Total pelanggan unik dari transaksi
        $totalCustomers = Transaction::distinct('id_transaction')->count('id_transaction');

        // Data penjualan 7 hari terakhir untuk Chart.js
        $salesData = Transaction::selectRaw('DATE(transaction_date) as date, COUNT(*) as total_sales, SUM(total_price) as revenue')
            ->where('transaction_date', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->get();

        return view('dashboard', compact('todaySales', 'todayRevenue', 'totalCustomers', 'salesData'));
    }
}

