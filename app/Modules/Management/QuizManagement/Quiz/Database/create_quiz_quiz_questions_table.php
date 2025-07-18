<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Management\QuizQuizQuestion\Database\create_quiz_quiz_questions_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quiz_id')->nullable();
            $table->bigInteger('quiz_question_id')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_quiz_questions');
    }
};