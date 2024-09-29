<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->default('Component Technician')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('roles_id')->references('id')->on('roles')
                ->onDelete('set null'); // при удалении роли юзер остается
        });


            // заполнение сразу в миграции

            DB::table('roles')->insert([
            ['name' => 'Component Technician'],
            ['name' => 'Team Leader'],
            ['name' => 'Shop Certifying Authority (SCA)'],
            ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};


