<?php
namespace App\Modules\Management\GalleryManagement\Gallery\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\GalleryManagement\Gallery\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\GalleryManagement\Gallery\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'gallery_category_id' => null,
                'title' => $faker->text(255),
                'description' => $faker->paragraph,
                'image' => $faker->text(255),
                'top_image' => $faker->boolean,
            ]);
        }
    }
}