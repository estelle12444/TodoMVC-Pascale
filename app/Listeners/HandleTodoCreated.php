<?php

namespace App\Listeners;

use App\Events\TodoCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleTodoCreated implements ShouldQueue
{

    use InteractsWithQueue;
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
    public function handle(TodoCreated $event): void
    {
        \Log::info("Nouveau todo créé:". $event->todo->name);
    }
}
