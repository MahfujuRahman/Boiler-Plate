<?php
namespace App\Modules\Management\CourseManagement\CourseInstructors\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\CourseManagement\CourseInstructors\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\CourseManagement\CourseInstructors\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'user_id' => null,
                'course_id' => null,
                'cover_photo' => $faker->text(255),
                'image' => $faker->text(255),
                'full_name' => $faker->text(100),
                'designation' => $faker->text(100),
                'short_description' => $faker->paragraph,
                'description' => $faker->text,
            ]);
        }
    }
}