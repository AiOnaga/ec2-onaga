<?php

namespace App\GraphQL\Queries;

use App\Models\Bookmark;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class BookmarkCount
{
    /**
     * @param       $root
     * @param array $args
     * @return int
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): int
    {
        $user = $context->user();
        $count = Bookmark::where('user_id', $user->id)->count();

        return $count;
    }
}
