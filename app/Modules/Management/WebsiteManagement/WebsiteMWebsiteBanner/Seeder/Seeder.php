<?php
namespace App\Modules\Management\WebsiteManagement\WebsiteMWebsiteBanner\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\WebsiteManagement\WebsiteMWebsiteBanner\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\WebsiteManagement\WebsiteMWebsiteBanner\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(255),
                'subtitle' => $faker->paragraph,
                'is_featured' => $faker->boolean,
                'image' => $faker->text(255),
                'btn_one_text' => $faker->text(50),
                'btn_one_url' => $faker->text(255),
                'btn_two_text' => $faker->text(50),
                'btn_two_url' => $faker->text(255),
            ]);
        }
    }
}