<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/WebsiteManagement/WebsiteMWebsiteBanner/Database/create_website_m_website_banners_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_m_website_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->text('subtitle')->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->string('image', 255)->nullable();
            $table->string('btn_one_text', 50)->nullable();
            $table->string('btn_one_url', 255)->nullable();
            $table->string('btn_two_text', 50)->nullable();
            $table->string('btn_two_url', 255)->nullable();

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
        Schema::dropIfExists('website_m_website_banners');
    }
};