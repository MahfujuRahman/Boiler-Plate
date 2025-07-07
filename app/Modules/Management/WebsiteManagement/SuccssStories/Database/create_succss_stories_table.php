<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/WebsiteManagement/SuccssStories/Database/create_succss_stories_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('succss_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('thumbnail_image', 255)->nullable();
            $table->string('video_link', 255)->nullable();

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
        Schema::dropIfExists('succss_stories');
    }
};