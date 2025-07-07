<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Management\CourseManagement\Course\Database\create_course_outcome_steps_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_outcome_steps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->integer('serial')->nullable();
            $table->string('title', 100)->nullable();

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
        Schema::dropIfExists('course_outcome_steps');
    }
};