<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Expense::factory(10)->create();
        \App\Models\Sale::factory(10)->create();
        \App\Models\SaleItem::factory(100)->create();

        \App\Models\User::create([
            'name' => 'Promise Mphoola',
            'email' => 'promisemphoola2@gmail.com',
            'password' => Hash::make('1234567890')]);
        \App\Models\User::create([
            'name' => 'User',
            'email' => 'test.user@gmail.com',
            'password' => Hash::make('1234567890')]);
    }
}
