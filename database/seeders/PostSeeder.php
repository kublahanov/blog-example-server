<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Post::factory(20)->create();

        // Post::factory(10)->create()->each(function ($post) {
        //     $tags = Tag::inRandomOrder()->take(random_int(1, 3))->pluck('id');
        //     $post->tags()->attach($tags);
        // });
    }
}
