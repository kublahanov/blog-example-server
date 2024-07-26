<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var $user User */
        $user = User::inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'user_id' => $user->id,
        ];
    }

    /**
     * @return PostFactory
     */
    public function configure(): PostFactory
    {
        return $this->afterCreating(function (Post $post) {
            $tags = Tag::inRandomOrder()->take(random_int(1, 3))->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
