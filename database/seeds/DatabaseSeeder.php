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
        factory(Branch::class, 5)->create();
        factory(User::class, 5)->create();
        factory(Product::class, 50)->create();
        factory(OwnerDocument::class, 50)->create();

        factory(Purchase::class, 150)->create()->each(function($purchase) {
            $max = random_int(8, 15);
            $i = 0;
            while ($i < $max) {
                factory(PurchaseDetail::class)->create([
                    'purchase_id' => $purchase->id,
                    'item' => $i + 1,
                    'purchase_code' => $purchase->code
                ]);
                $i++;
            }
        });
    }
}
