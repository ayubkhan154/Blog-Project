<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Faker\Factory;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::all()->pluck('id')->toArray();

        $limit = 200;
        $id = 1;

        for ($i = 0; $i < $limit; $i++) {
            $title = $faker->sentence($nbWords = 3, $variableNbWords = true);
            \DB::table('posts')->insert([
                'id' => $id++,
                'title' => $title,
                'body' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                'author_id' => Arr::random($users),
                'slug' => Str::slug($title),
                'active' => $faker->numberBetween(0, 1),
                'created_at' => \Carbon\Carbon::now(),
                'Updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
