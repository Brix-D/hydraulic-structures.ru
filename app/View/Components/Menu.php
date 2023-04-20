<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $menu = [];
        return view('components.menu', ['menu' => $menu]);
    }
}
