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
        Schema::create('t_attachment', function (Blueprint $table) {
            $table->id("attachment_id");
            $table->foreignId("fn_owner_id");
            $table->string("url", 255);
            $table->string("access_url", 255);
            $table->string("hashname", 255);
            $table->string('sha512')->index();
            $table->string("original_name", 255);
            $table->nullableMorphs('attachable');
            $table->unsignedBigInteger("file_size")->default(0);
            $table->boolean('persist')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_attachment');
    }
};
