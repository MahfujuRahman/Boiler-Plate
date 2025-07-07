<?php
namespace App\Modules\Management\CommunicationManagement\ContactMessage\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\CommunicationManagement\ContactMessage\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\CommunicationManagement\ContactMessage\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'full_name' => $faker->text(100),
                'email' => $faker->text(100),
                'subject' => $faker->text(255),
                'message' => $faker->paragraph,
                'is_seen' => $faker->boolean,
            ]);
        }
    }
}