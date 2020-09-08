<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Laboratory;
use App\Models\MeasureUnit;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerifyProductData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $product;

    private $account;

    public function __construct(Product $product)
    {
        $this->product = $product;

        $this->account = Account::find($product->branch->account_id);
    }

    public function handle()
    {
        $this->verifyCategory();
        $this->verifyBrand();
        $this->verifyLaboratory();
        $this->verifyMeasureUnit();
    }

    private function verifyCategory()
    {
        Category::firstOrCreate([
            'account_id' => $this->account->id,
            'name' => $this->product->category
        ]);
    }

    private function verifyBrand()
    {
        Brand::firstOrCreate([
            'account_id' => $this->account->id,
            'name' => $this->product->brand
        ]);
    }

    private function verifyLaboratory()
    {
        Laboratory::firstOrCreate([
            'account_id' => $this->account->id,
            'name' => $this->product->laboratory
        ]);
    }

    private function verifyMeasureUnit()
    {
        MeasureUnit::firstOrCreate([
            'account_id' => $this->account->id,
            'name' => $this->product->measure_unit
        ]);
    }
}
