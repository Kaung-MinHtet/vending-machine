<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalSales = Transaction::sum('total_price');
        $totalTransactions = Transaction::count();
        $latestTransactions = Transaction::with('user', 'product')->latest()->limit(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalSales', 'totalTransactions', 'latestTransactions'));
    }
}
