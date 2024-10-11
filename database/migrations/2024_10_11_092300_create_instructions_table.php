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
        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable();
        });


        DB::table('instructions')->insert([
            ['name' => 'OVERHAUL'],
            ['name' => 'REPAIR'],
            ['name' => 'TEST & INSPECT'],
            ['name' => '60M INSPECTION'],
            ['name' => '96M INSPECTION'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructions');
    }
};
