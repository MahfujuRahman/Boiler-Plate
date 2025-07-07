<?php
namespace App\Modules\Management\BlogManagement\Blog\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\BlogManagement\Blog\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\BlogManagement\Blog\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'blog_category_id' => null,
                'title' => $faker->text(100),
                'description' => $faker->paragraph,
                'tags' => $faker->paragraph,
                'publish_date' => $faker->dateTime,
                'writer' => $faker->text(100),
                'thumbnail_image' => $faker->text(100),
                'images' => $faker->paragraph,
                'blog_type' => $faker->text(100),
                'url' => $faker->text(100),
                'show_top' => $faker->text(100),
                'contributors' => json_encode([$faker->word, $faker->word]),
                'is_featured' => $faker->boolean,
                'is_published' => $faker->boolean,
            ]);
        }
    }
}