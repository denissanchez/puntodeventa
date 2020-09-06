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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        \Spatie\Permission\Models\Role::create(['name' => 'super-admin']);

        $user = factory(User::class)->make();
        $user->save();

        $user->assignRole('super-admin');
    }
}
