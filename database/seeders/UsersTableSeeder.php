<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $limit = 20;
        $id = 1;

        for ($i = 0; $i < $limit; $i++) {

            DB::table('users')->insert([
                'id' => $id++,
                'user_name' => $faker->userName,
                'first_name' => $faker->unique()->firstName,
                'last_name' => $faker->lastName,
                'role' => $faker->randomElement(['admin', 'author']),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'created_at' => \Carbon\Carbon::now(),
                'Updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
