<?php


namespace App\Utils\Reports;

use App\Models\Purchase;
use PDF;
use App\Utils\Interfaces\IReporte;

class ReportPurchases implements IReporte
{
    public function generate($startDate, $endDate)
    {
        $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('report.purchase.general',  [
            'purchases' => $purchases,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
        return $pdf;
    }
}
