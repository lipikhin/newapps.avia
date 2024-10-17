<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Instruction;
use App\Models\Manual;
use App\Models\Unit;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wos = WorkOrder::with(['unit','instruction','customer','user'])->get();
        return view('user.work_orders.index', compact('wos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        $users = User::all();
        $users = User::whereHas('role', function ($query) {
            $query->where('name', '!=', 'Shop Certifying Authority (SCA)');
        })->get();

        $units = Unit::all();
        $manuals = Manual::all();
        $instructions = Instruction::all();
        $customers = Customer::all();
        return view('user.work_orders.create', compact('users','units','manuals', 'instructions', 'customers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

//        dd($request);



        WorkOrder::create($request->all());



//            // Валидация данных
//            $validatedData = $request->validate([
//                'number_wo' => 'required|numeric|min:100000|max:999999',
//                'approve' => 'nullable',
//                'approve_at' => 'nullable',
////                'unit_id' => 'required|exists:units,id',
//                'serial_number' => 'required',
//                'instruction_id' => 'required|exists:instructions,id',
//                'customer_id' => 'required|exists:customers,id',
//                'open_at' => 'required|date',
//                'user_id' => 'required|exists:users,id',
//                'notes' => 'nullable',
//                'active' => 'true',
//            ]);

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
