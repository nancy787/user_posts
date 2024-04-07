<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Vote;
use Faker\Factory as Faker;

class PostDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $title = $faker->sentence();
            $content = $faker->sentence();
            $posts = rand(1, 5);
            for ($i = 0; $i < $posts; $i++) {
                $post = Post::factory()->create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'content' => $content
                ]);
                $votes = rand(0, 10);
                for ($j = 0; $j < $votes; $j++) {
                    $post->votes()->create([
                        'user_id' => $user->id
                    ]);
                }
            }
        }
    }
}
