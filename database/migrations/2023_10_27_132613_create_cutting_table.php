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
        Schema::create('cutting', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enhancer');
            $table->string('roll');
            $table->string('cutting_result');
            $table->string('material');
            $table->string('size');
            $table->string('model');
            $table->string('motive');
            $table->string('product');
            $table->date('date');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cutting');
    }
};
