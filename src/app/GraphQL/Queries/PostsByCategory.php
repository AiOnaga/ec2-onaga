<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostsByCategory
{
    /**
     * @param       $root
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function __invoke($root, array $args)
    {
        $category = $args['categoryId'];
        $posts = Post::with('categories')->whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category);
        })->get();

        return $posts;
    }
}
