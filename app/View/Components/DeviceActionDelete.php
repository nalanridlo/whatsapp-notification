<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DeviceActionDelete extends Component
{
    /**
     * Create a new component instance.
     */

    public $device;
    public $token;
    public function __construct($device, $token)
    {
        //
        $this->device = $device;
        $this->token = $token;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.device-action-delete', [
            'device' => $this->device,
            'token' => $this->token,
        ]);
    }
}
