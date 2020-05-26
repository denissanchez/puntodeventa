<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use function foo\func;

class ProductListTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testShowTable()
    {
        $this->browse(function (Browser $first, Browser $second) {
            $first->loginAs(User::find(1));

            $second->visit('/productos')
                    ->pause(2000)
                    ->assertPresent('#dataTable');
        });
    }
}
