@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-500 text-white p-4 rounded-lg">
            <h3 class="text-xl font-bold">Total Users</h3>
            <p class="text-3xl">{{ $totalUsers }}</p>
        </div>

        <div class="bg-green-500 text-white p-4 rounded-lg">
            <h3 class="text-xl font-bold">Total Products</h3>
            <p class="text-3xl">{{ $totalProducts }}</p>
        </div>

        <div class="bg-yellow-500 text-white p-4 rounded-lg">
            <h3 class="text-xl font-bold">Total Sales</h3>
            <p class="text-3xl">${{ number_format($totalSales, 2) }}</p>
        </div>

        <div class="bg-red-500 text-white p-4 rounded-lg">
            <h3 class="text-xl font-bold">Total Transactions</h3>
            <p class="text-3xl">{{ $totalTransactions }}</p>
        </div>
    </div>

    <h3 class="text-xl font-bold mt-6">Latest Transactions</h3>
    <table class="w-full border-collapse border border-gray-200 mt-3">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">User</th>
                <th class="p-2 border">Product</th>
                <th class="p-2 border">Quantity</th>
                <th class="p-2 border">Total Price</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestTransactions as $transaction)
            <tr class="border">
                <td class="p-2 border">{{ $transaction->user->name }}</td>
                <td class="p-2 border">{{ $transaction->product->name }}</td>
                <td class="p-2 border">{{ $transaction->quantity }}</td>
                <td class="p-2 border">${{ number_format($transaction->total_price, 2) }}</td>
                <td class="p-2 border">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
