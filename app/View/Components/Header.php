<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Header extends Component
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

        $currentTime = (new Carbon())->format('H:i');

        $user = Auth::user();
        return view('components.header', ['currentTime' => $currentTime, 'user' => $user]);
    }
}
