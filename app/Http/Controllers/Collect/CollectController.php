<?php

namespace App\Http\Controllers\Collect;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Reservoir;
use App\Models\Section;
use App\Models\SectionMeasure;
use App\Models\PumpMeasure;
use App\Http\Objects\PumpState;
use Illuminate\Validation\Rule;

class CollectController extends Controller {


    public function index(): View
    {
        $reservoirs = Reservoir::query()
        ->select(['name', 'id'])
        ->get();
        $sectionRoute = 'collect.add';
        $data = ['reservoirs' => $reservoirs, 'sectionRoute' => $sectionRoute];
        return view('pages.reservoirs.index',  $data);
    }

    public function create(Request $request, $id): View
    {
        $sections = Section::query()
            ->with(['pumps' => function($query) {
                return $query->select(['id', 'number', 'sectionId']);
            }])
            ->where('reservoirId', $id)
            ->select(['number', 'id'])
            ->get();
        
        $resevoir = Reservoir::query()
            ->where('id', $id)
            ->select(['name', 'id'])
            ->first();

        $pumpStates = collect(PumpState::all())->map(function ($state, $key) {
            return [
                'text' => $state,
                'value' => $key,
            ];
        });

        $backRoute = route('collect.index');

        $data = [
            'reservoirName' => $resevoir->name,
            'reservoirId' => $resevoir->getKey(),
            'backRoute' => $backRoute,
            'sections' => $sections,
            'pumpStates' => $pumpStates,
        ];
        return view('pages.collect.add', $data);
    }

    public function store(Request $request, $reservoirId, $sectionId): RedirectResponse
    {

        $data = $request->validateWithBag('section' . $sectionId, [
            'value' => 'required',
            'pumpId' => 'array',
            'pumpId.*' => 'required|integer',
            'pumpState' => 'array',
            'pumpState.*' => [
                'required',
                Rule::in(PumpState::values()),
            ]
        ], [
            'value.required' => 'Введите значение',
            'pumpId.array' => 'Поле должно быть массивом',
            'pumpId.*.required' => 'Введите значение',
            'pumpId.*.integer' => 'Поле должно быть числом',
            'pumpState.array' => 'Поле должно быть массивом',
            'pumpState.*.required' => 'Введите значение',
            'pumpState.*.in' => 'Необходимо выбрать',
        ]);

        $sectionMeasure = new SectionMeasure();
        $sectionMeasure->userId = $request->user()->getKey();
        $sectionMeasure->sectionId = (int) $sectionId;
        $sectionMeasure->value = $data['value'];
        $sectionMeasure->save();
        
        if (isset($data['pumpId']) && count($data['pumpId']) > 0) {
            foreach($data['pumpId'] as $index => $pumpId) {
                $pumpMeasure = new PumpMeasure();
                $pumpMeasure->userId = $request->user()->getKey();
                $pumpMeasure->pumpId = (int) $pumpId;
                $pumpMeasure->sectionMeasureId = $sectionMeasure->getKey();
                $pumpMeasure->state = $data['pumpState'][$index];
                $pumpMeasure->save();
            }
        }
        return redirect(route('collect.add', ['id' => $reservoirId]));
    }
}