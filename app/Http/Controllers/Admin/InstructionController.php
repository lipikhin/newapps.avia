<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the forms for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required|string|max:255',
//        ]);
//
//        $instruct = new Instruction();
//        $instruct->name = $request->name;
//        $instruct->save();
//
//        return response()->json($instruct);
//    }
    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            // Создание инструкции

            $instruct = new Instruction();
            $instruct->name = $request->name;
            $instruct->save();

            // Успешный ответ
            return response()->json([
                'success' => true,
                'id' => $instruct->id,
                'name' => $instruct->name,
            ]);
        } catch (\Exception $e) {
            // Логирование ошибки и ответ с кодом 500
            \Log::error('Ошибка при сохранении инструкции: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Ошибка при сохранении инструкции.'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the forms for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
