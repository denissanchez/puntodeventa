<?php


namespace App\Utils\Reports;


use App\Utils\Interfaces\IReporte;
use PDF;
use App\Models\Sale;

class ReportSales implements IReporte
{
    public function generate($startDate, $endDate)
    {
        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('report.sale.general',  [
            'sales' => $sales,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
        return $pdf;
    }
}
