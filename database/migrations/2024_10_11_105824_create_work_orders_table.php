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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('number')->unique();
            $table->boolean('approve')->default(false);
            $table->date('approve_at')->nullable();
            $table->foreignId('units_id')->constrained()->onDelete('cascade');
            $table->string('serial_number')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('instructions_id')->constrained()->onDelete('cascade');
            $table->foreignId('customers_id')->constrained()->onDelete('cascade');
            $table->date('open_at')->nullable();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
