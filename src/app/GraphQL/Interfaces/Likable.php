<?php

namespace App\GraphQL\Interfaces;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Likable extends BaseInterface
{
    public function __invoke($rootValue, GraphQLContext $context, ResolveInfo $resolveInfo): Type
    {
        $class_name = class_basename($rootValue);
        $type = '';
        if ($class_name == 'Post') {
            $type = 'Post';
        } elseif ($class_name == 'Comment') {
            $type = 'Comment';
        }

        return $this->typeRegistry->get($type);
    }
}
