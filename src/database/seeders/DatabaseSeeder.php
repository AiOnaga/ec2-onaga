<?php

namespace Database\Seeders;

use App\Models\Follow;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Bookmark;
use App\Models\Like;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usersを作成
        $users = User::factory()->count(10)->create();

        // Categoriesを作成
        Category::factory()->count(5)->create();

        // Postsを作成
        Post::factory()->count(20)->create();

        // Imagesを作成
        Image::factory()->count(10)->create();

        // Category_Post中間テーブルに関連付け
        $categories = Category::all();
        Post::all()->each(function ($post) use ($categories) {
            $post->categories()->attach(
                $categories->random(rand(1, 3))
            );
        });

        // Commentsを作成
        Comment::factory()->count(30)->create();

        // Bookmarksを作成
        Bookmark::factory()->count(30)->create();

        // Likesを作成 (PostとCommentの両方にLikeをつける例)
        $likeableTypes = ['App\Models\Post', 'App\Models\Comment'];
        Like::factory()->count(20)->create([
            'likeable_id' => function () use ($likeableTypes) {
                return $likeableTypes[array_rand($likeableTypes)]::inRandomOrder()->first()->id;
            },
            'likeable_type' => function () use ($likeableTypes) {
                return $likeableTypes[array_rand($likeableTypes)];
            },
        ]);

        Follow::factory()->count(20)->create();

    }
}

