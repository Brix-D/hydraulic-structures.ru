<?php

namespace App\Http\Controllers\Measure;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Reservoir;

class MeasureController extends Controller {


    public function index(): View
    {

        $reservoirs = Reservoir::query()
            ->select(['name', 'id'])
            ->get();
        $data = ['reservoirs' => $reservoirs];
        return view('pages.reservoirs.index', $data);
    }
}