<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function buy(Request $request, Product $product)
    {
        if ($product->quantity_available < $request->quantity) {
            return response()->json(['error' => 'Not enough stock available'], 400);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity_available,
        ]);

        $totalPrice = $product->price * $request->quantity;

        Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        $product->decrement('quantity_available', $request->quantity);

        return response()->json(['message' => 'Purchase successful']);
    }

    public function userTransactions()
    {
        return response()->json(auth()->user()->transactions()->with('product')->get());
    }

    public function allTransactions()
    {
        return response()->json(Transaction::with('user', 'product')->latest()->paginate(10));
    }
}

