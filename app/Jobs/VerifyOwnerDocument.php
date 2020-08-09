<?php

namespace App\Jobs;

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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
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
            OwnerDocument::create($owner_document);
        } else {
            $owner_document_bd->update($owner_document);
        }
    }
}
