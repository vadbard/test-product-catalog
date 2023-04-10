<?php

namespace App\Listeners;

use App\Events\Model\ProductDeletedEvent;
use App\Events\Model\ProductSavedEvent;

class ClearProductCacheListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductSavedEvent|ProductDeletedEvent $event): void
    {

    }
}
