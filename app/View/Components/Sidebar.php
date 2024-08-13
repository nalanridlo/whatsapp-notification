<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * The active page name.
     *
     * @var string
     */
    public $activePage;

    /**
     * Create a new component instance.
     *
     * @param string $activePage
     * @return void
     */
    public function __construct(string $activePage)
    {
        $this->activePage = $activePage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
