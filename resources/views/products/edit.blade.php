@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" class="w-full p-2 border rounded" value="{{ $product->name }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Price</label>
            <input type="number" name="price" class="w-full p-2 border rounded" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Quantity</label>
            <input type="number" name="quantity_available" class="w-full p-2 border rounded" value="{{ $product->quantity_available }}" required>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update</button>
    </form>
</div>
@endsection
