<?php

namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Reservoir;

class ReportController extends Controller {


    public function index(): View
    {
        $reservoirs = Reservoir::query()
        ->select(['name', 'id'])
        ->get();
        $sectionRoute = 'reports.view';
        $data = ['reservoirs' => $reservoirs, 'sectionRoute' => $sectionRoute];
        return view('pages.reservoirs.index', $data);
    }

    public function show(Request $request, $id): View
    {

        $resevoir = Reservoir::query()
            ->where('id', $id)
            ->select(['name', 'id'])
            ->first();

        $backRoute = route('reports.index');

        $data = [
            'reservoirName' => $resevoir->name,
            'reservoirId' => $resevoir->getKey(),
            'backRoute' => $backRoute,
        ];
        return view('pages.reports.view', $data);
    }

    public function chartMeasures(Request $request, $id)
    {
        $reservoir = Reservoir::query()
        ->where('id', $id)
        ->select(['name', 'id'])
        ->first();

        $measures = $reservoir->sections()
            ->with(['sectionMeasures' => function($query) {
                return $query->select(['id', 'value', 'createdAt', 'sectionId']);
            }])
            ->select(['id', 'number', 'color'])
            ->get();
       // dd($measures);
        return new JsonResponse(['measures' => $measures], JsonResponse::HTTP_OK);
    }
}