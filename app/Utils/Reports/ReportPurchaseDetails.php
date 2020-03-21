<?php


namespace App\Utils\Reports;

use App\Models\Purchase;
use App\Utils\Interfaces\IReporte;
use PDF;

class ReportPurchaseDetails implements IReporte
{
    public function generate($startDate, $endDate)
    {
        $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('report.purchase.details',  [
            'purchases' => $purchases,
            'start_date' => $startDate,
            'end_date' => $endDate
        ])->setPaper('a4', 'landscape');
        return $pdf;
    }
}
