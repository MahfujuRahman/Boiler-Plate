<?php
namespace App\Modules\Management\CourseManagement\CourseModuleClassResourse\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\CourseManagement\CourseModuleClassResourse\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\CourseManagement\CourseModuleClassResourse\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'course_id' => null,
                'course_module_class_id' => null,
                'course_module_id' => null,
                'resourse_content' => $faker->paragraph,
                'resourse_link' => $faker->text(100),
            ]);
        }
    }
}