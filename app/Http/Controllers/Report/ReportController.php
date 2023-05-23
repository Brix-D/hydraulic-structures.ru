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
            'request' => $request,
        ];
        return view('pages.reports.view', $data);
    }

    public function chartMeasures(Request $request, $id)
    {
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;

        $reservoir = Reservoir::query()
        ->where('id', $id)
        ->select(['name', 'id'])
        ->first();

        $measures = $reservoir->sections()
            ->with(['sectionMeasures' => function($query) use ($dateFrom, $dateTo) {
                return $query->select(['id', 'value', 'createdAt', 'sectionId'])
                ->when(isset($dateFrom), function ($query) use ($dateFrom) {
                    return $query->whereDate('createdAt', '>=', $dateFrom);
                })
                ->when(isset($dateTo), function ($query) use ($dateTo) {
                    return $query->whereDate('createdAt', '<=', $dateTo);
                });
            }])
            ->select(['id', 'number', 'color'])
            ->get();
       // dd($measures);
        return new JsonResponse(['measures' => $measures], JsonResponse::HTTP_OK);
    }
}