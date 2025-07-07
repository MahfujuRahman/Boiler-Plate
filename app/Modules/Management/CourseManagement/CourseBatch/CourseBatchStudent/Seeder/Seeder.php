<?php
namespace App\Modules\Management\CourseManagement\CourseBatch\CourseBatchStudent\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\CourseManagement\CourseBatch\CourseBatchStudent\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\CourseManagement\CourseBatch\CourseBatchStudent\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'course_id' => null,
                'batch_id' => null,
                'student_id' => null,
                'course_percent' => $faker->randomFloat(2, 0, 1000),
                'is_complete' => $faker->randomElement(array (
  0 => 'complete',
  1 => 'incomplete',
)),
            ]);
        }
    }
}