<?php
namespace App\Modules\Management\SeminerManagement\Seminer\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\SeminerManagement\Seminer\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\SeminerManagement\Seminer\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(255),
                'description' => $faker->paragraph,
                'poster' => $faker->text(255),
                'whatsapp_group' => $faker->sentence,
                'facebook_group' => $faker->text(255),
                'telegram_group' => $faker->text(255),
                'date_time' => $faker->dateTime,
                'promo_video' => $faker->paragraph,
            ]);
        }
    }
}