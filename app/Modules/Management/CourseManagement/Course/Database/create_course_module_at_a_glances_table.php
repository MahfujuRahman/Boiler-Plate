<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Management\CourseManagement\Course\Database\create_course_module_at_a_glances_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_module_at_a_glances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->text('title')->nullable();

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
        Schema::dropIfExists('course_module_at_a_glances');
    }
};