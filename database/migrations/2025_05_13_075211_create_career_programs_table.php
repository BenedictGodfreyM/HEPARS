<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('career_programs', function (Blueprint $table) {
            $table->engine = "InnoDB";
            (DB::getDriverName() === 'sqlite') ? $table->increments('id') : $table->bigIncrements('id');
            $table->string('program_id')->index();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->string('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_programs');
    }
};
