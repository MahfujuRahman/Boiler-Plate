<?php
namespace App\Modules\Management\CourseManagement\CourseBatch\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\CourseManagement\CourseBatch\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\CourseManagement\CourseBatch\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'course_id' => null,
                'batch_name' => $faker->text(100),
                'admission_start_date' => $faker->dateTime,
                'admission_end_date' => $faker->dateTime,
                'batch_student_limit' => null,
                'seat_booked' => $faker->randomNumber,
                'booked_percent' => $faker->randomFloat(2, 0, 1000),
                'course_price' => $faker->randomFloat(2, 0, 1000),
                'course_discount' => $faker->randomFloat(2, 0, 1000),
                'after_discount_price' => $faker->randomFloat(2, 0, 1000),
                'first_class_date' => $faker->dateTime,
                'class_days' => $faker->text(255),
                'class_start_time' => null,
                'class_end_time' => null,
                'show_percentage_on_cards' => $faker->randomElement(array (
  0 => 'yes',
  1 => 'no',
)),
            ]);
        }
    }
}