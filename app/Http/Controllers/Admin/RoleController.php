<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $role = Role::create($request->only('name'));

            return response()->json([
                'id' => $role->id,
                'name' => $role->name,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

//        $request->validate([
//            'name' => 'required|string|max:255',
//        ]);
//
//        $role = Role::create($request->only('name'));
//
//        return response()->json([
//            'id' => $role->id,
//            'name' => $role->name,
//        ]);
    }



//        // Валидация данных
//        $request->validate([
//            'name' => 'required|string|max:255',
//        ]);
//
//        // Создание новой роли
//        Role::create([
//            'name' => $request->name,
//        ]);
//
//        // Перенаправление с сообщением об успехе
//        return redirect()->back()->with('success', 'Role added successfully.');


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
