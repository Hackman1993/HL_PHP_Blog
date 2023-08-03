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
        Schema::create('t_article_category', function (Blueprint $table) {
            $table->id("art_category_id");
            $table->string("label");
            $table->uuid('_lft')->nullable();
            $table->uuid('_rgt')->nullable();
            $table->unsignedMediumInteger("priority")->default(0);
            $table->unsignedInteger('action_type')->default(0)->comment("0:正常文章列表 1:网址跳转 2 弹出二维码");
            $table->string("value")->default("")->comment("type为0时此处不生效， type为1时填入跳转网址");
            $table->uuid('fk_parent_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_article_category');
    }
};
