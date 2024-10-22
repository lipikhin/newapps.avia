<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $custs = Customer::all();
        return view('admin.customers.index',compact('custs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            // Создание инструкции

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->save();

            // Успешный ответ
            return response()->json([
                'success' => true,
                'id' => $customer->id,
                'name' => $customer->name,
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->save();

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully');
    }

}
