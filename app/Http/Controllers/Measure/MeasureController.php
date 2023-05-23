<?php

namespace App\Http\Controllers\Measure;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Reservoir;
use App\Models\Section;
use App\Models\SectionMeasure;
use App\Http\Objects\PumpState;

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
        $forwardRoute = 'measures.entries';
        $data = [
            'sections' => $sections,
            'resevoirName' => $resevoir->name,
            'resevoirId' => $resevoir->getKey(),
            'back' => $back,
            'forwardRoute' => $forwardRoute,
        ];
        return view('pages.sections.index', $data);
    }

    public function showSectionMeasures(Request $request, $reservoirId, $sectionId): View
    {
        $dateFrom = $request->dateFrom ?? null;
        $dateTo = $request->dateTo ?? null;
        // $resevoir = Reservoir::query()
        //     ->where('id', $reservoirId)
        //     ->select(['name', 'id'])
        //     ->first();

        $section = Section::query()
            ->where('id', $sectionId)
            ->with(['reservoir' => function ($query) {
                return $query->select(['id', 'name']);
            }])
            ->select(['id', 'number', 'reservoirId', 'warningValue', 'maximumValue'])
            ->first();

        $measures = SectionMeasure::query()
            ->where('sectionId', $sectionId)
            ->select(['id', 'value', 'createdAt', 'userId'])
            ->with([
                'user' => function ($query) {
                    return $query->select(['name', 'id']);
                },
                'pumpMeasures' => function ($query) {
                    return $query->select(['id', 'state', 'pumpId', 'sectionMeasureId'])
                        ->with(['pump' => function ($query) {
                            return $query->select(['id', 'number']);
                        }]);
                }
            ])
            ->when(isset($dateFrom), function ($query) use ($dateFrom) {
                return $query->whereDate('createdAt', '>=', $dateFrom);
            })
            ->when(isset($dateTo), function ($query) use ($dateTo) {
                return $query->whereDate('createdAt', '<=', $dateTo);
            })
            ->get();

        $measures = $measures->each(function ($sectionMeasure) use ($section) {
            $sectionMeasure->pump_measures = $sectionMeasure->pumpMeasures->each(function ($pumpMeasure) {
                $pumpMeasure->stateText = PumpState::getStateText($pumpMeasure->state);
                $pumpMeasure->color = 'text-primary';
                switch ($pumpMeasure->state) {
                    case PumpState::working(): {
                        $pumpMeasure->color = 'text-success';
                        break;
                    }
                    case PumpState::disabled(): {
                        $pumpMeasure->color = 'text-warning';
                        break;
                    } case PumpState::broken(): {
                        $pumpMeasure->color = 'text-error';
                        break;
                    }
                }
            });

            $sectionMeasure->color = 'text-primary';
            if ($sectionMeasure->value >= $section->warningValue) {
                $sectionMeasure->color = 'text-warning';
            }
            if ($sectionMeasure->value >= $section->maximumValue) {
                $sectionMeasure->color = 'text-error';
            }
        });

        $backRoute = route('measures.sections', ['id' => (int) $reservoirId]);
        $data = [
            'measures' => $measures,
            'backRoute' => $backRoute,
            'reservoir' => $section->reservoir,
            'section' => $section,
            'request' => $request,
        ];
        return view('pages.measures.view', $data);
    }
}