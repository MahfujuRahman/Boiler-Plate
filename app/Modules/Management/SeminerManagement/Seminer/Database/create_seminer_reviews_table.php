<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Management\SeminerReviews\Database\create_seminer_reviews_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seminer_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seminar_id')->nullable();
            $table->string('comment', 255)->nullable();
            $table->float('rating')->nullable();
            $table->json('comment_reply')->nullable();

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
        Schema::dropIfExists('seminer_reviews');
    }
};