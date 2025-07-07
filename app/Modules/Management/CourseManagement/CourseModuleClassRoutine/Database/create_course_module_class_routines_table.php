<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/CourseManagement/CourseModuleClassRoutine/Database/create_course_module_class_routines_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_module_class_routines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('module_id')->nullable();
            $table->bigInteger('class_id')->nullable();
            $table->date('date')->nullable();
            $table->string('time', 100)->nullable();
            $table->text('topic')->nullable();

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
        Schema::dropIfExists('course_module_class_routines');
    }
};