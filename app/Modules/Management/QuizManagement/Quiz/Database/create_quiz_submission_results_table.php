<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Management\QuizManagement\Quiz\Database\create_quiz_submission_results_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_submission_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('quiz_id')->nullable();
            $table->tinyInteger('submission_no')->default(0);
            $table->bigInteger('course_module_class_id')->nullable();
            $table->float('quiz_mark')->nullable();
            $table->float('obtain_mark')->nullable();
            $table->datetime('submission_datetime')->nullable();

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
        Schema::dropIfExists('quiz_submission_results');
    }
};