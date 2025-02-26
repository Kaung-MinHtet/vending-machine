@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Available Products</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">{{ $product->name }}</h3>
            <p class="text-gray-600">Price: ${{ number_format($product->price, 2) }}</p>
            <p class="text-gray-600">Available: {{ $product->quantity_available }}</p>

            @if($product->quantity_available > 0)
                <form action="{{ route('purchase.buy', $product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <input type="number" name="quantity" class="border p-2 w-full" placeholder="Enter quantity" min="1" max="{{ $product->quantity_available }}" required>
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 mt-2 rounded hover:bg-blue-600">Buy</button>
                </form>
            @else
                <button class="w-full bg-gray-400 text-white px-4 py-2 mt-2 rounded cursor-not-allowed" disabled>Out of Stock</button>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
