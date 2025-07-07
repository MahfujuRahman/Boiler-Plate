<?php
namespace App\Modules\Management\CourseManagement\CourseModuleClass\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\CourseManagement\CourseModuleClass\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\CourseManagement\CourseModuleClass\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'course_id' => null,
                'milestone_id' => null,
                'course_modules_id' => null,
                'class_no' => $faker->text(20),
                'title' => $faker->paragraph,
                'type' => $faker->randomElement(array (
  0 => 'live',
  1 => 'recorded',
)),
                'class_video_link' => $faker->text(150),
                'class_video_poster' => $faker->text(100),
            ]);
        }
    }
}