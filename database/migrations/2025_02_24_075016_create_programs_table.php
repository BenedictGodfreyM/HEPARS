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
        Schema::create('programs', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id')->primary();
            $table->string('institution_id')->index();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->string('name');
            $table->tinyInteger("duration");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
