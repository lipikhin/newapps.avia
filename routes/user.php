<?php


use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InstructionController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TrainingController;
use App\Http\Controllers\User\UserCmmController;
use App\Http\Controllers\User\WorkOrderController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->middleware(['auth'])->group(function (){


//    Route::redirect('/user','/user/work_orders')->name('user');
//
//
    Route::get('work_orders',[WorkOrderController::class,
        'index'])->name('user.work_orders.index');

    Route::get('work_orders/create',[WorkOrderController::class,
        'create'])->name('user.work_orders.create');

    Route::post('work_orders/store',[WorkOrderController::class,
        'store'])->name('user.work_orders.store');

    Route::get('work_orders/{work_order}',
        [WorkOrderController::class,'show'])->name('user.work_orders.show');

    Route::get('work_orders/{work_orders}/edit',
        [WorkOrderController::class,'edit'])->name('user.work_orders.edit');

    Route::put('work_orders/{work_order}',
        [WorkOrderController::class,'update'])->name('user.work_orders.update');

    Route::delete('work_orders/{work_order}',
        [WorkOrderController::class, 'destroy'])->name('user.work_orders.destroy');

    Route::post('work_orders/check_number', [WorkOrderController::class, 'checkNumber'])->name('user.work_orders.checkNumber');


    Route::post('instruction/store',[InstructionController::class,'store'])->name('user.instruction.store');
    Route::post('customer/store',[CustomerController::class,'store'])->name('user.customer.store');
    Route::post('unit/store_workorder',[UnitController::class,'store'])->name
    ('user.unit.store_workorder');

    Route::get('profile', [ProfileController::class, 'index'])->name('user.profile.profile');
    Route::get('profile/create', [ProfileController::class, 'create'])->name('user.profile.create');
    Route::post('profile', [ProfileController::class, 'store'])->name('user.profile.store');
    Route::get('profile/{profile}', [ProfileController::class, 'show'])->name('user.profile.show');
    Route::get('profile/{profile}/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('profile/{profile}', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('profile/{profile}', [ProfileController::class, 'destroy'])->name('user.profile.destroy');
    Route::post('/profile/changePassword', [ProfileController::class, 'changePassword'])->name('user.profile.changePassword');



    Route::get('trainings', [TrainingController::class, 'index'])->name('user.trainings.index');
    Route::get('trainings/create', [TrainingController::class, 'create'])
        ->name('user.trainings.create');
    Route::post('trainings', [TrainingController::class, 'store'])->name
    ('user.trainings.store');
    Route::post('/update-training/{id}', [TrainingController::class, 'updateTraining'])->name('updateTraining');
    Route::post('/trainings/createTraining', [TrainingController::class, 'createTraining'])->name('user.trainings.createTraining');

    Route::get('trainings/form112/{id}', [TrainingController::class, 'showForm112'])->name('user.trainings.form112');
    Route::get('trainings/form132/{id}', [TrainingController::class, 'showForm132'])->name('user.trainings.form132');




//    Route::prefix('trainings')->group(function() {


        // Список всех тренингов
//        Route::get('/createForm112/{id}', [UserCmmController::class, 'createForm112'])->name('user.trainings.createForm112'); // Создание формы 112
//        Route::post('/storeForm112/{id}', [UserCmmController::class, 'storeForm112'])->name('user.trainings.storeForm112'); // Сохранение формы 112
//        Route::get('/{id}', [UserCmmController::class, 'show'])->name('user.trainings.show'); // Просмотр конкретного тренинга
//


});


