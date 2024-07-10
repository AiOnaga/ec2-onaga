<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = Category::all();
        Post::factory()->count(15)->create();

        Post::all()->each(function ($post) use ($categories) {
            $post->categories()->sync(
                $categories->random(rand(1, 2))->pluck('id')->mapWithKeys(function ($id) {
                    return [
                        $id => [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                    ];
                })->toArray()
            );
        });
    }
}
