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
        Schema::create('entry_requirements', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('program_id')->index();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->string('subject_id')->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->char('min_grade', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_requirements');
    }
};
