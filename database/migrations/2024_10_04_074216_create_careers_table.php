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
            $table->string(column: 'name');
            $table->integer('amount');
            $table->integer('level');
            $table->text('description');
            $table->text('requirements');
            $table->text('benefits');
            $table->float('salary_min')->nullable();
            $table->float('salary_max')->nullable();
            $table->boolean('negotiable')->default(true);
            $table->boolean('status')->default(true);
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();
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
