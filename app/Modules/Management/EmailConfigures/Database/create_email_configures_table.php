<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/EmailConfigures/Database/create_email_configures_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_configures', function (Blueprint $table) {
            $table->id();
            $table->string('host', 255)->nullable();
            $table->integer('port')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('mail_from_name', 255)->nullable();
            $table->string('mail_from_email', 255)->nullable();
            $table->tinyInteger('encryption')->default(0);

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
        Schema::dropIfExists('email_configures');
    }
};