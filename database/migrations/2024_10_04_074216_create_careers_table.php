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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('department_id');
            $table->string(column: 'career_name');
            $table->integer('career_amount');
            $table->integer('career_level');
            $table->text('career_description');
            $table->text('career_require');
            $table->integer('career_status');
            $table->date('career_end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
