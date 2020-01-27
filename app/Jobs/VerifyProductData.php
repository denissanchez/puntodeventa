<?php

namespace App\Jobs;

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

    public function __construct(Product $product)
    {
        $this->product = $product;
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
            'name' => $this->product->category
        ]);
    }

    private function verifyBrand()
    {
        Brand::firstOrCreate([
            'name' => $this->product->brand
        ]);
    }

    private function verifyLaboratory()
    {
        Laboratory::firstOrCreate([
            'name' => $this->product->laboratory
        ]);
    }

    private function verifyMeasureUnit()
    {
        MeasureUnit::firstOrCreate([
            'name' => $this->product->measure_unit
        ]);
    }
}
