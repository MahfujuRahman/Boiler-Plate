<?php
namespace App\Modules\Management\TestModule\ComprehensiveDataTypeTest\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\TestModule\ComprehensiveDataTypeTest\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\TestModule\ComprehensiveDataTypeTest\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'basic_string' => $faker->sentence,
                'long_string' => $faker->text(255),
                'short_string' => $faker->text(50),
                'description' => $faker->paragraph,
                'long_content' => $faker->text,
                'basic_number' => null,
                'quantity' => null,
                'count' => $faker->randomNumber,
                'typo_integer' => null,
                'user_id' => null,
                'category_id' => null,
                'priority' => null,
                'unsigned_count' => null,
                'unsigned_id' => null,
                'birth_year' => null,
                'is_active' => $faker->boolean,
                'price' => $faker->randomFloat(2, 0, 1000),
                'weight' => null,
                'amount' => null,
                'birth_date' => $faker->date,
                'created_at_fju' => $faker->dateTime,
                'event_time' => null,
                'start_time' => null,
                'last_seen' => null,
                'metadata' => json_encode([$faker->word, $faker->word]),
                'status_fhdj' => $faker->randomElement(array (
  0 => 'active',
  1 => 'inactive',
  2 => 'pending',
)),
                'difficulty' => $faker->randomElement(array (
  0 => 'easy',
  1 => 'medium',
  2 => 'hard',
)),
                'avatar' => $faker->sentence,
                'document' => null,
                'binary_data' => null,
                'identifier' => null,
                'user_password' => null,
            ]);
        }
    }
}