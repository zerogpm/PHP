<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Faker\Provider\DateTime;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {

            DB::table('lesson')->insert([
                'title' => $faker->sentence(5),
                'body' => $faker->paragraph(4),
                'confirmed' => $faker->boolean(),
                'Added_on'  => $faker->dateTime($max = 'now')
            ]);
        }

    }


}
      