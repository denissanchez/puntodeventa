<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\OwnerDocument;
use App\Utils\Interfaces\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerifyOwnerDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $document;
    private $account;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->account = Account::find($document->branch->account_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $owner_document = unserialize($this->document->getOwnerDocument());
        $owner_document_bd = OwnerDocument::where('identity_document', $owner_document['identity_document'])->first();
        if (!$owner_document_bd) {
            $owner = new OwnerDocument($owner_document);
            $owner->account_id = $this->account->id;
            $owner->save();
        } else {
            $owner_document_bd->update($owner_document);
        }
    }
}
