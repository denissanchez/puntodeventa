<?php


namespace App\Utils;


use App\Models\Branch;
use App\Models\ControlStock;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StockLog
{
    private $detail;
    private $type;

    public function __construct($detail, $type)
    {
        $this->detail = $detail;
        $this->type = $type;
    }

    public function store()
    {
        $product = Product::where('id', $this->detail['product_id'])->first();

        $control_stock = ControlStock::create([
            'branch_id' = Auth::user()->branch_id,
            'user_name' => Auth::user()->name,
            'product_id' => $this->detail['product_id'],
            'product_code' => $product->code,
            'product_name' => $product->name,
            'document_code' => $this->detail['purchase_code'],
            'type' => $this->type,
            'quantity' => $this->detail['init_quantity']
        ]);
    }
}
