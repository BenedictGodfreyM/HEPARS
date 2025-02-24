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
        Schema::create('institutions', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('id')->primary();
            $table->string('name');
            $table->char('acronym', 10);
            $table->enum('type', ["University","University College","University Campus College","Non-University"]);
            $table->enum('ownership', ["Private","Public"]);
            $table->char('code', 5);
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
