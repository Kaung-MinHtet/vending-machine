<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 text-white">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-lg font-bold">Vending Machine</a>
            <div class="flex">
                @auth
                    <span>Welcome, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="ml-4 text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="ml-4 text-white">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <!-- Breadcrumb-style Navigation Under Navbar -->
    @if(auth()->check())
    <div class="bg-gray-100 py-2">
        <div class="max-w-6xl mx-auto px-4 flex flex-wrap space-x-4">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:underline">Dashboard</a>
                <span>|</span>
                <a href="{{ route('admin.transactions.index') }}" class="text-blue-500 hover:underline">Transactions</a>
                <span>|</span>
                <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">All Products</a>
                <span>|</span>
                <a href="{{ route('products.create') }}" class="text-blue-500 hover:underline">Add Product</a>
                <span>|</span>
            @endif
            <a href="{{ route('purchase.index') }}" class="text-blue-500 hover:underline">Buy Products</a>
            <span>|</span>
            <a href="{{ route('purchase.history') }}" class="text-blue-500 hover:underline">My Purchases</a>
        </div>
    </div>
    @endif
    
    
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>
</html>
