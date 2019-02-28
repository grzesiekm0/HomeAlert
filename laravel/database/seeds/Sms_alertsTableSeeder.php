<?php

use Illuminate\Database\Seeder;
use App\SmsAlert;
class Sms_alertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Let's truncate our existing records to start from scratch.
      SmsAlert::truncate();

      $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            SmsAlert::create([
                'phone' => $faker->sentence,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
