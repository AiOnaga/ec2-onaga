<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LikeFactory extends Factory
{
    protected $model = Like::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $likeableType = $this->faker->randomElement([Post::class, Comment::class]);
        return [
            'user_id' => User::factory(),
            'likeable_id' => $likeableType::factory(),
            'likeable_type' => $likeableType,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
