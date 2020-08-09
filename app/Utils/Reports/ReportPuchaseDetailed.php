<?php


namespace App\Utils\Reports;

use App\Models\Purchase;
use App\Utils\Interfaces\IReporte;
use PDF;

class ReportPuchaseDetailed implements IReporte
{
    public function generate($startDate, $endDate)
    {
        $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('report.purchase.detailed',  [
            'purchases' => $purchases,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
        return $pdf;
    }
}
