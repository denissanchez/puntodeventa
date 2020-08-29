<?php


namespace App\Utils;


use App\Models\Product;
use App\Utils\Interfaces\IReporte;
use PDF;

class ReportStock implements IReporte
{
    public function generate($startDate, $endDate)
    {
        $products = Product::whereBetween('updated_at', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('report.product.general',  [
            'products' => $products,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
        return $pdf;
    }
}
