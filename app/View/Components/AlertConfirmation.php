<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AlertConfirmation extends Component
{
    public $title;
    public $message;
    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $message
     */
    public function __construct($title = 'Default Title', $message = 'Default Message')
    {
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-confirmation');
    }
}
