<?php

namespace App\Jobs;

use App\Models\SaleDetail;
use App\Utils\MovementInfo;
use App\Utils\StockLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStockOnSale implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $sale_detail;

    public function __construct(SaleDetail $sale_detail)
    {
        $this->sale_detail = $sale_detail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stock_log = new StockLog($this->sale_detail, MovementInfo::SALE_MOVEMENT);
        $stock_log->store();
    }
}
