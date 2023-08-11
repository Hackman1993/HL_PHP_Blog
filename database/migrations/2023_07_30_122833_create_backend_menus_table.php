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
        Schema::create('t_backend_menu', function (Blueprint $table) {
            $table->id("backend_menu_id");
            $table->string("icon")->nullable();
            $table->string("menu_code", 255);
            $table->string("url", 255)->nullable();
            $table->unsignedBigInteger("_lft")->nullable();
            $table->unsignedBigInteger("_rgt")->nullable();
            $table->foreignId("parent_id")->nullable();
            $table->foreignId("fn_permission_id")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_backend_menu');
    }
};
