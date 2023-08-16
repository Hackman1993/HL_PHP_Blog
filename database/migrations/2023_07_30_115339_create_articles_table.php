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
        Schema::create('t_article', function (Blueprint $table) {
            $table->id("article_id");
            $table->text("title");
            $table->longText("content");
            $table->foreignId("fn_author_id");
            $table->foreignId("fn_category_id");
            $table->text("abstract");

            $table->unsignedInteger("order")->default(0);
            $table->text("keywords");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_article');
    }
};
