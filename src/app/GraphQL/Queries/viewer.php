<?php

namespace App\GraphQL\Queries;

use App\Models\User;

final class viewer
{
    public function __invoke($root, array $args, $context)
    {

        return [
            'id' => '1',
            'name' => 'viewer',
            'email' => 'email'
        ];
    }
}
