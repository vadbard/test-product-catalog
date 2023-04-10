<?php

namespace App\Providers;

use App\Events\Model\CategoryDeletedEvent;
use App\Events\Model\CategorySavedEvent;
use App\Events\Model\ProductDeletedEvent;
use App\Events\Model\ProductSavedEvent;
use App\Listeners\ClearCategoryCachesListener;
use App\Listeners\ClearProductCacheListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CategorySavedEvent::class => [
            ClearCategoryCachesListener::class,
        ],
        CategoryDeletedEvent::class => [
            ClearCategoryCachesListener::class,
        ],

        ProductSavedEvent::class => [
            ClearProductCacheListener::class,
        ],
        ProductDeletedEvent::class => [
            ClearProductCacheListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
