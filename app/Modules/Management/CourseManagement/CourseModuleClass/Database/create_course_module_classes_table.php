<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/CourseManagement/CourseModuleClass/Database/create_course_module_classes_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_module_classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('milestone_id')->nullable();
            $table->bigInteger('course_modules_id')->nullable();
            $table->string('class_no', 20)->nullable();
            $table->text('title')->nullable();
            $table->enum('type', ['live','recorded'])->nullable();
            $table->string('class_video_link', 150)->nullable();
            $table->string('class_video_poster', 100)->nullable();

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
        Schema::dropIfExists('course_module_classes');
    }
};