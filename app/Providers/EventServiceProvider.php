<?php

namespace App\Providers;

use App\Events\TodoCreated;
use App\Events\TodoUpdated;
use App\Events\TodoDeleted;
use App\Listeners\HandleTodoCreated;
use App\Listeners\HandleTodoDeleted;
use App\Listeners\HandleTodoUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TodoCreated::class => [
            HandleTodoCreated::class,
        ],
        TodoUpdated::class => [
            HandleTodoUpdated::class,
        ],
        TodoDeleted::class => [
            HandleTodoDeleted::class,
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
