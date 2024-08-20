<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Header extends Component
{   
    public $userName;
    public $userEmail;
    /**
     * Create a new component instance.
     */
    public function __construct($userName = 'admin', $userEmail = 'admin@example.com')
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}