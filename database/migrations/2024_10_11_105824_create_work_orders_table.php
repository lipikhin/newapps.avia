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

            $table->integer('number_wo')->unique();
            $table->boolean('approve')->default(false);
            $table->date('approve_at')->nullable();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->string('amendment')->nullable();
            $table->string('serial_number')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('instruction_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->date('open_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('active')->default(true);

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
