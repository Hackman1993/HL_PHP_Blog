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
        Schema::create('t_frontend_menu', function (Blueprint $table) {
            $table->id('frontend_menu_id');
            $table->string("menu_code", 255);
            $table->unsignedInteger("type")->nullable();
            $table->text("value");
            $table->foreignId("parent_id")->nullable();
            $table->foreignId("_lft")->nullable();
            $table->foreignId("_rgt")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_frontend_menu');
    }
};
