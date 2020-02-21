<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total_products = Product::all()->count();
        $total_purchases = Purchase::where('created_at', '>=', Carbon::now()->subDay())->groupBy('id')->get()->count();
        $total_sales = Sale::where('created_at', '>=', Carbon::now()->subDay())->groupBy('id')->get()->count();
        return view('home', [
            'total_products' => $total_products,
            'total_purchases' => $total_purchases,
            'total_sales' => $total_sales,
        ]);
    }
}
