<?php

use App\Models\Branch;
use App\Models\Product;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(Branch::class, 5)->create();
        factory(User::class, 5)->create();
        factory(Product::class, 150)->create();
    }
}
