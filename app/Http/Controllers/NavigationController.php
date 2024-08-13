<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function dashboard()
    {
        return view('components.dashboard', [
            'activePage' => 'dashboard',
        ]);
    }

    public function users()
    {
        return view('components.users', [
            'activePage' => 'users',
        ]);
    }

    public function device()
    {
        return view('components.device', [
            'activePage' => 'device',
        ]);
    }

}
