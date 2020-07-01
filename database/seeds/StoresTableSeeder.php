<?php

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'ruc' => '12345678456',
            'name' => 'Principal SAC',
            'address' => 'Av. Principal 544'
        ]);

        Store::create([
            'ruc' => '12345678416',
            'name' => 'Secundaria 1 SAC',
            'address' => 'Av. Secundaria 544'
        ]);

        Store::create([
            'ruc' => '12345678423',
            'name' => 'Secundaria 2 SAC',
            'address' => 'Av. Secundaria 2544'
        ]);
    }
}
