<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;


final class Post
{
    public function __invoke($root, array $args, $context)
    {
        $user = 1;

        return \App\Models\Post::where('user_id', $user)->get();
    }
}
