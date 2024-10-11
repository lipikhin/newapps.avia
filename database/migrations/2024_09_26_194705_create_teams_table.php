<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('teams_id')->references('id')->on('teams')
                ->onDelete('set null'); // при удалении роли юзер остается
        });

        DB::table('teams')->insert([
            ['name' => 'Management'],
            ['name' => 'Akimov`s team'],
            ['name' => 'Blinov`s team'],
            ['name' => 'Steblyk`s team'],
            ['name' => 'Tchalyi`s team'],
            ['name' => 'Barysevich`s team'],
            ['name' => 'Volker`s team'],
            ['name' => 'Never stop`s team'],
            ['name' => 'Lipikhin`s team'],
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
