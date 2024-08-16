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
    public $nama;
    public $phone_number;
    public $tanggalLahir;
    public $reminder_date;
    public $expire_date;

    public function __construct( $nama , $phone_number , $tanggalLahir, $reminder_date, $expire_date )
    {
        //

        $this->nama = $nama;
        $this->phone_number = $phone_number;
        $this->tanggalLahir = $tanggalLahir;
        $this->reminder_date = $reminder_date;
        $this->expire_date = $expire_date;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-items');
    }
}
