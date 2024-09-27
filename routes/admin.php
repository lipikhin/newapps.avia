<?php

use App\Http\Controllers\Admin\AirCraftController;
use App\Http\Controllers\Admin\BuilderController;
use App\Http\Controllers\Admin\CmmController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ManualController;
use App\Http\Controllers\Admin\MFRController;
use App\Http\Controllers\Admin\PlaneController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScopeController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\User\TrainingController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Admin\UnitController;
//use App\Http\Controllers\Admin\WorkOrderController;

Route::prefix('admin')->middleware(['auth'])->group(function (){

//    Route::redirect('/admin','/admin/work_orders')->name('admin');
//
//    Route::get('work_orders',[WorkOrderController::class,
//        'index'])->name('admin.work_orders');
//
//    Route::get('work_orders/create',[WorkOrderController::class,
//        'create'])->name('admin.work_orders.create');
//
//    Route::post('work_orders',[WorkOrderController::class,
//        'store'])->name('admin.work_orders.store');
//
//    Route::get('work_orders/{work_order}',
//        [WorkOrderController::class,'show'])->name('admin.work_orders.show');
//
//    Route::get('work_orders/{work_orders}/edit',
//        [WorkOrderController::class,'edit'])->name('admin.work_orders.edit');
//
//    Route::put('work_orders/{work_order}',
//        [WorkOrderController::class,'update'])->name('admin.work_orders.update');
//
//    Route::delete('work_orders/{work_order}',
//        [WorkOrderController::class, 'destroy'])->name('admin.work_orders.destroy');


    Route::get('customers',[CustomerController::class,
        'index'])->name('admin.customers.index');
    Route::get('customers/create',[CustomerController::class,
        'create'])->name('admin.customers.create');
    Route::post('customers',[CustomerController::class,
        'store'])->name('admin.customers.store');
    Route::get('customers/{customers}',[CustomerController::class,
        'show'])->name('admin.customers.show');
    Route::get('customers/{customers}/edit',[CustomerController::class,
        'edit'])->name('admin.customers.edit');
    Route::put('customers/{customers}',[CustomerController::class,
        'update'])->name('admin.customers.update');
    Route::delete('customers/{customers}',[CustomerController::class,
        'destroy'])->name('admin.customers.destroy');

    Route::get('cmms',[ManualController::class, 'index'])->name('admin.cmms.index');
    Route::get('cmms/create',[ManualController::class, 'create'])->name('admin.cmms.create');
    Route::post('cmms',[ManualController::class,
        'store'])->name('admin.cmms.store');
    Route::get('cmms/{cmms}',[ManualController::class,
        'show'])->name('admin.cmms.show');
    Route::get('cmms/{cmms}/edit',[ManualController::class,
        'edit'])->name('admin.cmms.edit');
    Route::put('cmms/{cmms}',[ManualController::class,
        'update'])->name('admin.cmms.update');
    Route::delete('cmms/{cmms}',[ManualController::class,
        'destroy'])->name('admin.cmms.destroy');

    Route::post('/planes/store',[PlaneController::class,
        'store'])->name('admin.planes.store');
    Route::post('/builders/store',
        [BuilderController::class,'store'])->name('admin.builders.store');
    Route::post('/scopes/store',
        [ScopeController::class,'store'])->name('admin.scopes.store');

    Route::get('units',[UnitController::class, 'index'])->name('admin.units.index');
    Route::get('units/create',
        [UnitController::class,'create'])->name('admin.units.create');
    Route::post('units',[UnitController::class,'store'])->name('admin.units.store');
    Route::get('units/{unit}',[UnitController::class,
        'show'])->name('admin.units.show');
    Route::get('units/{unit}/edit',[UnitController::class,
        'edit'])->name('admin.units.edit');
    Route::put('units/{unit}',[UnitController::class,
        'update'])->name('admin.units.update');
    Route::delete('units/{unit}',[UnitController::class,
        'destroy'])->name('admin.units.destroy');

// В вашем routes/
    Route::get('units/{manualId}', [UnitController::class,
        'getUnitsByManual'])->name('admin.units.byManual');
// web.php
    Route::post('/units/update/{manualId}', [UnitController::class, 'updateUnits'])->name('units.update');




    Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/users',[UsersController::class,'store'])->name('admin.users.store');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('admin.users.update');

    Route::get('/users/{users}/edit', [UsersController::class, 'edit'])->name
    ('admin.users.edit');

    Route::delete('/users/{users}', [UsersController::class, 'destroy'])->name
    ('admin.users.destroy');




    Route::post('/roles/store', [RoleController::class, 'store'])->name('admin.roles.store');

    Route::post('/teams/store', [TeamController::class, 'store'])->name('admin.teams.store');

    Route::prefix('trainings')->group(function() {
        Route::get('/', [TrainingController::class, 'index'])->name('admin.trainings.index'); // Список всех тренингов
        Route::get('/createForm132/{id}', [TrainingController::class, 'createForm132'])->name('admin.trainings.createForm132'); // Создание формы 132
        Route::post('/storeForm132/{id}', [TrainingController::class, 'storeForm132'])->name('admin.trainings.storeForm132'); // Сохранение формы 132
        Route::get('/createForm112/{id}', [TrainingController::class, 'createForm112'])->name('admin.trainings.createForm112'); // Создание формы 112
        Route::post('/storeForm112/{id}', [TrainingController::class, 'storeForm112'])->name('admin.trainings.storeForm112'); // Сохранение формы 112
        Route::get('/{id}', [TrainingController::class, 'show'])->name('admin.trainings.show'); // Просмотр деталей тренинга
        Route::delete('/{id}', [TrainingController::class, 'destroy'])->name('admin.trainings.destroy'); // Удаление тренинга
    });

});
