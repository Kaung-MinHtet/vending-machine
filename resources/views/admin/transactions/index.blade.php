@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">All Transactions</h2>

    <!-- Filtering Form -->
    <form method="GET" action="{{ route('admin.transactions.index') }}" class="mb-4 flex flex-col lg:flex-row gap-4">
        <select name="user_id" class="p-2 border rounded min-w-[150px]">
            <option value="">Filter by User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>

        <select name="product_id" class="p-2 border rounded min-w-[200px]">
            <option value="">Filter by Product</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
            @endforeach
        </select>

        <input type="date" name="start_date" value="{{ request('start_date') }}" class="p-2 border rounded">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="p-2 border rounded">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
    </form>

    <!-- Transactions Table -->
    <table class="w-full border-collapse border border-gray-200">
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
            @foreach($transactions as $transaction)
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
    
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
