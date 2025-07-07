<?php
namespace App\Modules\Management\EmailConfigures\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\EmailConfigures\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\EmailConfigures\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'host' => $faker->text(255),
                'port' => $faker->randomNumber,
                'email' => $faker->text(255),
                'username' => $faker->text(255),
                'password' => $faker->text(255),
                'mail_from_name' => $faker->text(255),
                'mail_from_email' => $faker->text(255),
                'encryption' => $faker->boolean,
            ]);
        }
    }
}