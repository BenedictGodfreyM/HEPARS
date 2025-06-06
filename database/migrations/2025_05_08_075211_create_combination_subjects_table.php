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
        Schema::create('combination_subjects', function (Blueprint $table) {
            $table->engine = "InnoDB";
            (DB::getDriverName() === 'sqlite') ? $table->increments('id') : $table->bigIncrements('id');
            $table->string('combination_id')->index();
            $table->foreign('combination_id')->references('id')->on('combinations')->onDelete('cascade');
            $table->string('subject_id')->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combination_subjects');
    }
};
