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
        Schema::create('t_rendering_job', function (Blueprint $table) {
            $table->id('job_id');
            $table->string('name')->unique()->index();
            $table->string('job_key')->unique()->index();
            $table->foreignId('owner_id');
            $table->foreignId('status');
            $table->integer('frame_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_rendering_job');
    }
};
