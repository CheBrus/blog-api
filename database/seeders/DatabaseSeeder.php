<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)->create();
        Category::factory(30)->create();
        $posts = Post::factory(150)->create();

        foreach ($posts as $post) {
            /** @var Post $post */
            $post->categories()->attach(rand(1, 15));
            $post->categories()->attach(rand(16, 30));
        }
    }
}
