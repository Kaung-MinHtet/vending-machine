@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">My Purchase History</h2>

    @if($transactions->isEmpty())
        <p class="text-gray-600">You haven't made any purchases yet.</p>
    @else
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Product</th>
                    <th class="p-2 border">Quantity</th>
                    <th class="p-2 border">Total Price</th>
                    <th class="p-2 border">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr class="border">
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
    @endif
</div>
@endsection
