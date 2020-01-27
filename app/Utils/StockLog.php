<?php


namespace App\Utils;


use App\Models\ControlStock;
use Illuminate\Support\Facades\Auth;

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
        $control_stock = ControlStock::create([
            'branch_id' = Auth::user()->branch_id,
            'product_id' = $this->detail->product->id,
            'product_code' = $this->detail->product->code,
            'product_name' = $this->detail->product->name,
            'document_name' = $this->detail->document->code,
            'type' = $this->type,
            'quantity' = $this->detail->quantity
        ]);
    }
}
