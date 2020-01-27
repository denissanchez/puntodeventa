<?php

namespace App\Jobs;

use App\Models\PurchaseDetail;
use App\Utils\MovementInfo;
use App\Utils\StockLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStockOnPurchase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $purchase_detail;

    public function __construct(PurchaseDetail $purchase_detail)
    {
        $this->purchase_detail = $purchase_detail;
    }

    public function handle()
    {
        $stock_log = new StockLog($this->purchase_detail, MovementInfo::PURCHASE_MOVEMENT);
        $stock_log->store();
    }
}
