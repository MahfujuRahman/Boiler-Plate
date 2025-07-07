<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/SeminerManagement/Seminer/Database/create_seminers_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seminers', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('poster', 255)->nullable();
            $table->string('whatsapp_group', 100)->nullable();
            $table->string('facebook_group', 255)->nullable();
            $table->string('telegram_group', 255)->nullable();
            $table->datetime('date_time')->nullable();
            $table->text('promo_video')->nullable();

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
        Schema::dropIfExists('seminers');
    }
};