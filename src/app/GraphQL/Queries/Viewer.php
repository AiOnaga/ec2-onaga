<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Log;

class Viewer
{
        public function __invoke($root, array $args, GraphQLContext $context)
    {
        Log::info('Resolving viewer');

        // 特定のユーザーを取得（例としてIDが1のユーザーを取得）
        $user = User::find(1);

        if (!$user) {
            Log::error('User not found');
            throw new \Exception('User not found');
        }

        Log::info('User found:', ['user' => $user]);

        return $user;
    }
}
