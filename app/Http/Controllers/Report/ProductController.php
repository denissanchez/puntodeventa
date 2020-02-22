<?php

namespace App\Http\Controllers\Report;

use PDF;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function export() {
        $products = Product::all();
        $pdf = PDF::loadView('report.product.general', $products);
        return $pdf->download('product.pdf');
    }
}
