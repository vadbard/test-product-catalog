<?php

namespace App\Listeners;

use App\Events\Model\ProductDeletedEvent;
use App\Events\Model\ProductSavedEvent;
use App\Services\Cache\ProductRepositoryCacheClearService;

class ClearProductCacheListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private ProductRepositoryCacheClearService $cacheClearService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductSavedEvent|ProductDeletedEvent $event): void
    {
        $this->cacheClearService->clearById($event->product->id);
        $this->cacheClearService->clearListByCategoryId($event->product->category_id);
    }
}
