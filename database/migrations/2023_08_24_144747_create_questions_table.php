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
        Schema::create('g_question', function (Blueprint $table) {
            $table->id('question_id');
            $table->text('question_text')->fulltext();
            $table->text('question_html')->fulltext();
            $table->json('option_data');
            $table->text('solution')->fulltext();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_question');
    }
};
