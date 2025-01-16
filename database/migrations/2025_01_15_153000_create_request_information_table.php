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
        Schema::create('request_information', function (Blueprint $table) {
            $table->id();
            $table->string('requestId')->unique();
            $table->string('referencia')->unique();
            $table->string('status');
            $table->dateTime('date');
            $table->decimal('valorTotal');
            $table->string('moneda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_information');
    }
};
