<?php


namespace App\Utils\Reports;

use App\Scopes\AvailableStateScope;
use PDF;
use App\Models\Product;
use App\Utils\Interfaces\IReporte;

class ReportMostSelled implements IReporte
{
    public function generate($startDate, $endDate)
    {
        $products = Product::withoutGlobalScopes([AvailableStateScope::class])->whereBetween('updated_at', [$startDate, $endDate])->orderBy('sold_units', 'desc')->get();
        $pdf = PDF::loadView('report.product.most-selled',  [
            'products' => $products,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
        return $pdf;
    }
}
