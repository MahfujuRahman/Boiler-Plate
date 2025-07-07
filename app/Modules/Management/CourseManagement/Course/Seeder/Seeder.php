<?php
namespace App\Modules\Management\CourseManagement\Course\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\CourseManagement\Course\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\CourseManagement\Course\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'course_category_id' => null,
                'title' => $faker->text(255),
                'image' => $faker->text(255),
                'intro_video' => $faker->text(255),
                'published_at' => $faker->date,
                'is_published' => $faker->boolean,
                'what_is_this_course' => $faker->paragraph,
                'why_is_this_course' => $faker->paragraph,
                'type' => $faker->randomElement(array (
  0 => 'online',
  1 => 'offline',
  2 => 'daycare',
)),
            ]);
        }
    }
}