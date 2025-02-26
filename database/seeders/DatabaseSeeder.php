<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
    
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        Product::create([
            'name' => "Coke",
            'price' => 3.99,
            'quantity_available' => 60
        ]);

        Product::create([
            'name' => "Pepsi",
            'price' => 6.885,
            'quantity_available' => 125
        ]);

        Product::create([
            'name' => "Water",
            'price' => 0.5,
            'quantity_available' => 87
        ]);
    }
}
