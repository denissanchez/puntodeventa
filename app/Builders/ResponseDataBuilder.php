<?php


namespace App\Builders;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Laboratory;
use App\Models\MeasureUnit;
use App\Models\OwnerDocument;
use App\Models\Product;

class ResponseDataBuilder
{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    private function add_collection(string $key, $collection)
    {
        $this->data = array_merge($this->data, [$key => $collection]);
    }

    public function categories()
    {
        $this->add_collection('categories', Category::all());
        return $this;
    }

    public function brands()
    {
        $this->add_collection('brands', Brand::all());
        return $this;
    }

    public function laboratories()
    {
        $this->add_collection('laboratories', Laboratory::all());
        return $this;
    }

    public function measure_units()
    {
        $this->add_collection('measure_units', MeasureUnit::all());
        return $this;
    }

    public function providers()
    {
        $this->add_collection('providers', OwnerDocument::onlyCompanies()->get());
        return $this;
    }

    public function products()
    {
        $this->add_collection('products', Product::all());
        return $this;
    }

    public function build()
    {
        return $this->data;
    }
}
