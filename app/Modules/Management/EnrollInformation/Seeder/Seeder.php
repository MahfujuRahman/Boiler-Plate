<?php
namespace App\Modules\Management\EnrollInformation\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\EnrollInformation\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\EnrollInformation\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'course_id' => null,
                'student_id' => null,
                'batch_id' => null,
                'payment_type' => $faker->randomElement(array (
  0 => 'offline',
  1 => 'online',
)),
                'payment_by' => $faker->text(50),
                'receipt_id' => $faker->text(255),
                'trx_id' => $faker->text(255),
                'payment_status' => $faker->randomElement(array (
  0 => 'paid',
  1 => 'unpaid',
  2 => 'failed',
)),
                'total_amount' => $faker->randomFloat(2, 0, 1000),
                'paid_amount' => $faker->randomFloat(2, 0, 1000),
            ]);
        }
    }
}