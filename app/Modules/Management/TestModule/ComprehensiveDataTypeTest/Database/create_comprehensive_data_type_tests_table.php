<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/TestModule/ComprehensiveDataTypeTest/Database/create_comprehensive_data_type_tests_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comprehensive_data_type_tests', function (Blueprint $table) {
            $table->id();
            $table->string('basic_string', 100)->nullable();
            $table->string('long_string', 255)->nullable();
            $table->string('short_string', 50)->nullable();
            $table->text('description')->nullable();
            $table->longtext('long_content')->nullable();
            $table->integer('basic_number')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('count')->nullable();
            $table->integer('typo_integer')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->enum('priority', ['hi','no'])->nullable();
            $table->unsignedInteger('unsigned_count')->nullable();
            $table->unsignedInteger('unsigned_id')->nullable();
            $table->year('birth_year')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->float('price')->nullable();
            $table->double('weight')->nullable();
            $table->decimal('amount')->nullable();
            $table->date('birth_date')->nullable();
            $table->datetime('created_at_fju')->nullable();
            $table->datetime('event_time')->nullable();
            $table->time('start_time')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->json('metadata')->nullable();
            $table->enum('status_fhdj', ['active','inactive','pending'])->nullable();
            $table->enum('difficulty', ['easy','medium','hard'])->nullable();
            $table->string('avatar', 100)->nullable();
            $table->string('document', 100)->nullable();
            $table->binary('binary_data')->nullable();
            $table->uuid('identifier')->nullable();
            $table->string('user_password', 100)->nullable();

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
        Schema::dropIfExists('comprehensive_data_type_tests');
    }
};