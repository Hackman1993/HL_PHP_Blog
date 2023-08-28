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
        Schema::create('g_sign_record', function (Blueprint $table) {
            $table->id('sign_record_id');
            $table->string('name', 10);
            $table->string('phone', 20);
            $table->timestamps();
            $table->unique(['name', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_sign_record');
    }
};
