<?php

namespace App\Observers;

use App\Jobs\VerifyOwnerDocument;
use App\Models\Sale;
use App\Utils\DocumentInfo;

class SaleObserver
{
    public function created(Sale $sale)
    {
        VerifyOwnerDocument::dispatch($sale);
        $client_document = $sale->client['identity_document'];
        $type = (strlen($client_document) === 11) ? DocumentInfo::FACTURA : DocumentInfo::BOLETA;
        $billing_code = $sale->generateBillingCode($type);
        $sale->code = $billing_code->code;
        $sale->save();
    }

    public function updated(Sale $sale)
    {
        //
    }

    public function deleted(Sale $sale)
    {
        //
    }

    public function restored(Sale $sale)
    {
        //
    }

    public function forceDeleted(Sale $sale)
    {
        //
    }
}
