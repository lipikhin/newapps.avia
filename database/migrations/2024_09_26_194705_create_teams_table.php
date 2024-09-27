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

            $table->string('name')->default('Aviatechnik Corp.')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('teams_id')->references('id')->on('teams')
                ->onDelete('set null'); // при удалении роли юзер остается
        });

        DB::table('roles')->insert([
            ['name' => 'Management'],
            ['name' => 'Akimov`s team'],
            ['name' => 'Shop Certifying Authority (SCA)'],
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
