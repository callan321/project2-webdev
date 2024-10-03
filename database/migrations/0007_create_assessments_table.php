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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('name', 20);
            $table->text('instruction');
            $table->integer('number_of_reviews')->unsigned();
            $table->integer('max_score')->unsigned()->default(100);
            $table->date('due_date');
            $table->time('due_time');
            $table->enum('type', ['student-select', 'teacher-assign']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
