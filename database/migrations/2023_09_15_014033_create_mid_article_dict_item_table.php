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
        Schema::create('t_mid_article_dict_item', function (Blueprint $table) {
            $table->foreignId('fn_dict_item_id')->index();
            $table->foreignId('fn_article_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_mid_article_dict_item');
    }
};
