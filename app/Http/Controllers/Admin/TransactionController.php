<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user', 'product')->latest();

        $query->when($request->user_id, function($query) use ($request) {
            $query->where('user_id', $request->user_id);
        })
        ->when($request->product_id, function($query) use ($request) {
            $query->where('product_id', $request->product_id);
        })
        ->when(($request->start_date || $request->end_date), function($query) use ($request) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        });

        // if ($request->filled('user_id')) {
        //     $query->where('user_id', $request->user_id);
        // }

        // if ($request->filled('product_id')) {
        //     $query->where('product_id', $request->product_id);
        // }

        // if ($request->filled('start_date') && $request->filled('end_date')) {
        //     $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        // }

        $transactions = $query->paginate(10);
        $users = \App\Models\User::all();
        $products = \App\Models\Product::all();

        return view('admin.transactions.index', compact('transactions', 'users', 'products'));
    }

}
