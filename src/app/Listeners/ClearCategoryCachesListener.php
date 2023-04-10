<?php

namespace App\Listeners;

use App\Events\Model\CategoryDeletedEvent;
use App\Events\Model\CategorySavedEvent;
use App\Services\Cache\CategoryRepositoryCacheClearService;

class ClearCategoryCachesListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private CategoryRepositoryCacheClearService $cacheClearService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CategorySavedEvent|CategoryDeletedEvent $event): void
    {
        $this->cacheClearService->clearAllParentsTrees($event->category);
        $this->cacheClearService->clearCategory($event->category);
    }
}
