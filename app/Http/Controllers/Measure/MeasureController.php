<?php

namespace App\Http\Controllers\Measure;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MeasureController extends Controller {


    public function index(): View
    {
        return view('pages.structures.index');
    }
}