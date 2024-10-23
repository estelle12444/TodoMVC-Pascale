<?php

namespace App\Events;

use App\Domain\Todo\Todo;
use App\Models\Todo as ModelsTodo;
use Illuminate\Foundation\Events\Dispatchable;

class TodoCreated
{
    use Dispatchable;

    public function __construct(public readonly ModelsTodo $todo){}
}
