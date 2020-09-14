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



        \Spatie\Permission\Models\Permission::create(['name' => 'view products']);
        \Spatie\Permission\Models\Permission::create(['name' => 'add purchases']);
        \Spatie\Permission\Models\Permission::create(['name' => 'view purchases']);
        \Spatie\Permission\Models\Permission::create(['name' => 'add sales']);
        \Spatie\Permission\Models\Permission::create(['name' => 'view sales']);

        $super_admin = \Spatie\Permission\Models\Role::create(['name' => 'super-admin']);
        \Spatie\Permission\Models\Role::create(['name' => 'account-administrator']);
        \Spatie\Permission\Models\Role::create(['name' => 'seller'])->givePermissionTo([
            'view products', 'add purchases', 'view purchases', 'add sales', 'view sales'
        ]);



        $user = factory(User::class)->make();
        $user->save();

        $user->assignRole('super-admin');
    }
}
