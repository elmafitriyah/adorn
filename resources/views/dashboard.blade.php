@extends('templates.default')

public function index()
{
    // Mengambil total penjualan hari ini berdasarkan transaction_date
    $todaySales = Transaction::whereDate('transaction_date', now())->count();

    return view('dashboard', compact('todaySales'));
}
