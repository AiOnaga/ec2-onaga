<?php

namespace App\GraphQL\Interfaces;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\TypeRegistry;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

abstract class BaseInterface
{
    /**
     * The type registry.
     *
     * @var \Nuwave\Lighthouse\Schema\TypeRegistry
     */
    protected $typeRegistry;

    public function __construct(TypeRegistry $typeRegistry)
    {
        $this->typeRegistry = $typeRegistry;
    }

    /**
     * Decide which GraphQL type a resolved value has.
     *
     * @param  mixed  $rootValue The value that was resolved by the field. Usually an Eloquent model.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo
     * @return \GraphQL\Type\Definition\Type
     */
    public function __invoke($rootValue, GraphQLContext $context, ResolveInfo $resolveInfo): Type
    {
        // Default to getting a type with the same name as the passed in root value
        // implement your own resolver logic - if the default is fine, just delete this class
        return $this->typeRegistry->get(class_basename($rootValue));
    }
}
