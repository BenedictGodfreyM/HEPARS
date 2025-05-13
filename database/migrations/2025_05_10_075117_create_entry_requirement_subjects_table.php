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
        Schema::create('entry_requirement_subjects', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('entry_requirement_id')->index();
            $table->foreign('entry_requirement_id')->references('id')->on('entry_requirements')->onDelete('cascade');
            $table->string('subject_id')->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->enum('type', ["required","optional","necessary"]);
            $table->char('min_grade', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_requirement_subjects');
    }
};
