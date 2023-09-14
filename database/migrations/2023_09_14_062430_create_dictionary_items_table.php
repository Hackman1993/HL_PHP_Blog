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
        Schema::create('t_dictionary_item', function (Blueprint $table) {
            $table->id('dict_item_id');
            $table->string('text');
            $table->string('item_key');
            $table->boolean('translate');
            $table->foreignId('fn_dictionary_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_dictionary_item');
    }
};
