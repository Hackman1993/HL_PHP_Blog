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
        Schema::create('t_dictionary', function (Blueprint $table) {
            $table->id('dictionary_id');
            $table->string('key')->unique()->index()->nullable();
            $table->string('text');
            $table->boolean('translate')->default(false);

            $table->foreignId("_lft")->nullable();
            $table->foreignId("_rgt")->nullable();
            $table->foreignId("parent_id")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_dictionary');
    }
};
