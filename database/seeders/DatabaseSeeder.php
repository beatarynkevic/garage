<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $faker = Faker::create('lt_LT');

        $mechanics = 6;
        foreach(range(1,$mechanics) as $_) {
        DB::table('mechanics')->insert([
            'name' => $faker->firstName(),
            'surname' => $faker->lastName(),
        ]);
        }

        $trucks = 10;
        foreach(range(1,$trucks) as $_) {
        DB::table('trucks')->insert([
            'maker' => str_replace(['.', '"', "'", ';', '(', ')'], '', $faker->realText(rand(10,45))),
            'plate' => $faker->buildingNumber(),
            'make_year' => rand(22, 555),
            'mechanic_notices' => $faker->realText(400, 4),
            'mechanic_id' => rand(1, $mechanics)
        ]);
      }
    }
}
