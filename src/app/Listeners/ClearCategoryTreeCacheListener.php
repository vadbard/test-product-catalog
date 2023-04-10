<?php

namespace App\Listeners;

use App\Events\Model\CategoryDeletedEvent;
use App\Events\Model\CategorySavedEvent;

class ClearCategoryTreeCacheListener
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
    public function handle(CategorySavedEvent|CategoryDeletedEvent $event): void
    {

    }
}
