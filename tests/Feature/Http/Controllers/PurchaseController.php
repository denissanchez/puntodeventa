<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PurchaseController extends TestCase
{
    use WithoutMiddleware;

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testStorePurchase()
    {
        $response = $this->call('POST', '/compras', [
            'provider' => [
                'identity_document' => '12345678965',
                'name' => 'DENIS SANCHEZ',
            ],
            'date' => '17/12/2019',
            'products' => [
                0 => [
                    'id' => 1,
                    'quantity' => 14.4,
                    'unit_price' => 17.4,
                ]
            ]
        ]);

        $this->assertEquals(200, $response->status());
    }
}
