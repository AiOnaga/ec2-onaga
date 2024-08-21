<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PostByBookmark
{
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->user();
        Log::info('User found:', ['user' => $user]);
        $posts = $user->bookmarks()->get();
        Log::info('Bookmarks found:', ['bookmarks' => $posts]);

        return $posts;

    }
}
