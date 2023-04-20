<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        $menu = [
            ['name' => 'Профиль', 'icon' => 'person', 'link' => 'auth.index'],
            ['name' => 'Запись', 'icon' => 'edit', 'link' => 'welcome'],

        ];

        $currentRoute = Route::current()->getName();
        return view('components.menu', ['menu' => $menu, 'currentRoute' => $currentRoute]);
    }
}
