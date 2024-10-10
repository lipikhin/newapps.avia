<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Builder;
use App\Models\Manual;
use App\Models\Plane;
use App\Models\Scope;
use App\Models\Unit;
use Illuminate\Http\Request;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Получаем все units и связанные с ними manuals
        $units = Unit::with('manuals')->get();

        // Проверка загруженных данных
        if ($units->isEmpty()) {
            // Если юнитов нет, возвращаем представление с сообщением
            return view('admin.units.index', [
                'message' => 'No units available at the moment.', // Сообщение о том, что юнитов нет
                'restManuals' => Manual::whereNotIn('id', [])->get(),
                'manuals' => Manual::all(),
                'planes' => Plane::pluck('type', 'id'),
                'builders' => Builder::pluck('name', 'id'),
                'scopes' => Scope::pluck('scope', 'id'),
                'groupedUnits' => collect() // Пустая коллекция
            ]);
        }
            // Если юниты есть, продолжаем обработку
        $manualIdsInUnits = $units->pluck('manuals_id')->toArray();

        // Если юниты есть, продолжаем обработку
        $manualIdsInUnits = $units->pluck('manuals_id')->toArray();
        $groupedUnits = $units->groupBy(function ($unit) {
            return $unit->manuals ? $unit->manuals->number : 'No CMM';
        });

        // Подготовка общих данных для отображения в виде
        $restManuals = Manual::whereNotIn('id', $manualIdsInUnits)->get();
        $manuals = Manual::all();
        $planes = Plane::pluck('type', 'id');
        $builders = Builder::pluck('name', 'id');
        $scopes = Scope::pluck('scope', 'id');

        // Передаем данные в представление
        return view('admin.units.index', compact('groupedUnits', 'restManuals', 'manuals', 'planes', 'builders', 'scopes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manuals = Manual::all();
        $planes = Plane::all(); // Получить все объекты AirCraft
        $builders = Builder::all(); // Получить все объекты MFR
        $scopes = Scope::all(); // Получить все объекты Scope

        return view('admin.units.create', compact('manuals','planes', 'builders',
            'scopes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cmm_id' => 'required|exists:manuals,id',
            'part_numbers' => 'required|array',
            'part_numbers.*' => 'string|distinct',
        ]);

        \DB::transaction(function() use ($request) {
            foreach ($request->part_numbers as $partNumber) {
                Unit::create([
                    'manuals_id' => $request->cmm_id,
                    'part_number' => $partNumber,
                ]);
            }
        });

        return response()->json(['success' => true]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $manualId)
    {
        // Убедитесь, что вы правильно получаете юниты
        $units = Unit::where('manuals_id', $manualId)->get();

        // Возвращаем данные в формате JSON
        return response()->json(['units' => $units]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($manualsId)
    {
        // Проверяем, что manual существует
        $manual = Manual::findOrFail($manualsId);

        // Получаем все units, связанные с данным manuals_id
        $units = Unit::where('manuals_id', $manualsId)->get();

        if ($units->isEmpty()) {
            return redirect()->back()->with('error', 'No units found for the selected manual.');
        }

        return view('admin.units.edit', compact('manual', 'units'));
    }

    public function getUnitsByManual($manualId)
    {
        $units = Unit::where('manuals_id', $manualId)->get();

        return response()->json([
            'units' => $units,
        ]);
    }

    public function update($manualId, Request $request)
    {
//        dd($request, $manualId);
        $partNumbers = $request->input('part_numbers');

        // Логика для добавления и удаления part_number из базы данных
        foreach ($partNumbers as $partNumber) {
            // Добавление или обновление логики для part_number
            Unit::updateOrCreate(
                ['manuals_id' => $manualId, 'part_number' => $partNumber],
                ['manuals_id' => $manualId, 'part_number' => $partNumber]
            );
        }

        // Вернуть JSON ответ
        return response()->json(['success' => true]);
    }



    /**
     * Update the specified resource in storage.
     */


    public function updateUnits(Request $request, $manualId)
    {
        \Log::info('Request received:', ['manuals_id' => $manualId, 'part_numbers' => $request->input('part_numbers')]);
        try {
            $manual = Manual::findOrFail($manualId);

            $existingPartNumbers = $manual->units()->pluck('part_number')->toArray();
            $newPartNumbers = $request->input('part_numbers');

            \Log::info('Existing part numbers:', $existingPartNumbers);
            \Log::info('New part numbers:', $newPartNumbers);

            // Удаляем все part_number, которых нет в новом списке
            Unit::where('manuals_id', $manualId)
                ->whereNotIn('part_number', $newPartNumbers)
                ->delete();

            foreach ($newPartNumbers as $partNumber) {
                if (!in_array($partNumber, $existingPartNumbers)) {
                    $manual->units()->firstOrCreate(['part_number' => $partNumber]);
                }
            }

            return response()->json([
                'success' => true,
                'updated_units' => $manual->units()->get()
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating units: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while updating units'
            ], 500);
        }
    }


//        $manual = Manual::findOrFail($manualId);
//
//        // Получить существующие part_numbers
//        $existingPartNumbers = $manual->units()->pluck('part_number')->toArray();
//
//        // Новые part_numbers из запроса
//        $newPartNumbers = $request->input('part_numbers');
//
//        // Удаляем те, которых нет в новых данных
//        $manual->units()->whereNotIn('part_number', $newPartNumbers)->delete();
//
//        // Добавляем новые part_numbers, которых не было
//        foreach ($newPartNumbers as $partNumber) {
//            if (!in_array($partNumber, $existingPartNumbers)) {
//                $manual->units()->create([
//                    'part_number' => $partNumber
//                ]);
//            }
//        }
//
//        return response()->json(['success' => true]);



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $manualId)
    {
        // Получаем мануал по полю 'number'
        $manual = Manual::where('number', $manualId)->first();

        // Если мануал найден, удаляем связанные юниты
        if ($manual) {
            // Удаляем все юниты, связанные с выбранным мануалом
            Unit::where('manuals_id', $manual->id)->delete();

            // Перенаправляем на индекс с сообщением об успешном удалении
            return redirect()->route('admin.units.index')->with('success', 'Все юниты успешно удалены.');
        }

        // Если мануал не найден, возвращаем ошибку
        return redirect()->route('admin.units.index')->with('error', 'Мануал не найден.');
    }

//        $unit = Unit::findOrFail($id);
//        $unit->delete();
//        return redirect()->route('admin.units.index')->with('success', 'Unit has been deleted');


}
