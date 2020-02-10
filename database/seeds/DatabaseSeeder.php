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
        $branch = Branch::create([
            'ruc' => '12345678965',
            'name' => 'MARAC TEST',
            'address' => '-',
            'email' => '-',
            'phone' => '-',
            'website' => '-',
        ]);

        $user = User::create([
            'branch_id' => $branch->id,
            'name' => 'QA',
            'email' => 'qa@marac.tec',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

//        factory(Branch::class, 5)->create();
//        factory(User::class, 5)->create();
//        factory(OwnerDocument::class, 50)->create();

//        factory(Purchase::class, 150)->create()->each(function($purchase) {
//            $max = random_int(8, 15);
//            $i = 0;
//            while ($i < $max) {
//                factory(PurchaseDetail::class)->create([
//                    'purchase_id' => $purchase->id,
//                    'item' => $i + 1,
//                    'purchase_code' => $purchase->code
//                ]);
//                $i++;
//            }
//        });
    }
}
