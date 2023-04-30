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

        $user = Auth::user();
        $menu = [
            ['name' => 'Профиль', 'icon' => 'person', 'link' => 'profile.index', 'group' => 'profile'],
        ];

        if ($user->hasPermissionTo('store-measure')) {
            $menu[] =  ['name' => 'Запись', 'icon' => 'edit', 'link' => 'collect.index', 'group' => 'collect'];
        }

        if ($user->hasAnyPermission(['view-measure', 'edit-measure'])) {
            $menu[] =  ['name' => 'Журнал', 'icon' => 'receipt_long', 'link' => 'measures.index', 'group' => 'measures'];
        }

        if ($user->hasPermissionTo('view-reports')) {
            $menu[] =  ['name' => 'Отчеты', 'icon' => 'stacked_line_chart', 'link' => 'reports.index', 'group' => 'reports'];
        }

        $currentRoute = Route::current()->getName();
        return view('components.menu', ['menu' => $menu, 'currentRoute' => $currentRoute]);
    }
}
