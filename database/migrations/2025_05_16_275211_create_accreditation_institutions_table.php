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
        Schema::create('accreditation_institutions', function (Blueprint $table) {
            $table->engine = "InnoDB";
            (DB::getDriverName() === 'sqlite') ? $table->increments('id') : $table->bigIncrements('id');
            $table->string('accreditation_id')->index();
            $table->foreign('accreditation_id')->references('id')->on('accreditations')->onDelete('cascade');
            $table->string('institution_id')->index();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accreditation_institutions');
    }
};
