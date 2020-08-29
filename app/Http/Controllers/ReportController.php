<?php

namespace App\Http\Controllers;

use App\Utils\Report;
use App\Utils\Reports\ReportMostSelled;
use App\Utils\Reports\ReportPuchaseDetailed;
use App\Utils\Reports\ReportPurchaseDetails;
use App\Utils\Reports\ReportPurchases;
use App\Utils\Reports\ReportSales;
use App\Utils\ReportStock;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generate(Request $request)
    {
        $type = $request->get('type');
        $start_date = $request->get('startDate');
        $end_date =  $request->get('endDate');
        $pdf = new Report($this->getReportInstance($type));
        $pdf->setRange($start_date, $end_date);
        return ($pdf->generate())->download('report_'.date('d-m-Y').'.pdf');
    }

    public function getReportInstance($type)
    {
        switch ($type) {
            case 0:
                return new ReportStock;
                break;
            case 1:
                return new ReportMostSelled;
                break;
            case 2:
                return new ReportPurchases;
                break;
            case 3:
                return new ReportPuchaseDetailed;
                break;
            case 4:
                return new ReportPurchaseDetails;
                break;
            case 5:
                return new ReportSales;
                break;
        }
    }
}
