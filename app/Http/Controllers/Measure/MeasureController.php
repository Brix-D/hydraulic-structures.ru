<?php

namespace App\Http\Controllers\Measure;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Reservoir;
use App\Models\Section;

class MeasureController extends Controller {


    public function index(): View
    {

        $reservoirs = Reservoir::query()
            ->select(['name', 'id'])
            ->get();
        $sectionRoute = 'measures.sections';
        $data = ['reservoirs' => $reservoirs, 'sectionRoute' => $sectionRoute];
        return view('pages.reservoirs.index', $data);
    }

    public function sections(Request $request, $id): View
    {
        $sections = Section::query()
            ->where('reservoirId', $id)
            ->select(['number', 'id'])
            ->get();

        $resevoir = Reservoir::query()
            ->where('id', $id)
            ->select(['name', 'id'])
            ->first();

        $back = 'measures.index';
        $forwardRoute = '';
        $data = [
            'sections' => $sections,
            'resevoirName' => $resevoir->name,
            'back' => $back,
            'forwardRoute' => $forwardRoute,
        ];
        return view('pages.sections.index', $data);
    }
}