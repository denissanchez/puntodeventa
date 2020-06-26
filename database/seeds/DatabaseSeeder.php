<?php

use App\Models\Branch;
use App\Models\OwnerDocument;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 10)->create();
    }
}
