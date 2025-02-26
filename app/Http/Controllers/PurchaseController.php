<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        // $products = Product::where('quantity_available', '>', 0)->get();
        $products = Product::get();
        return view('purchase.index', compact('products'));
    }

    public function buy(Request $request, Product $product)
    {
        if ($product->quantity_available <= 0) {
            return redirect()->route('purchase.index')->with('error', 'This product is out of stock!');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity_available,
        ]);

        $quantity = $request->input('quantity');
        $totalPrice = $quantity * $product->price;

        // Create transaction
        Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);

        // Reduce product quantity
        $product->decrement('quantity_available', $quantity);

        return redirect()->route('purchase.index')->with('success', 'Purchase successful!');
    }


    public function history()
    {
        $transactions = auth()->user()->transactions()->with('product')->latest()->paginate(10);
        return view('purchase.history', compact('transactions'));
    }
}
