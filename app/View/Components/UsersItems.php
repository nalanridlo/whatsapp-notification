<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsersItems extends Component
{
    /**
     * Create a new component instance.
     */
    public $reminder;

    public function __construct( $reminder)
    {
        //

        $this->reminder = $reminder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users-items');
    }
}
