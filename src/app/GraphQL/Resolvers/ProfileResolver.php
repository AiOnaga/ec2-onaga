<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Log;

class ProfileResolver
{
    public function resolveProfile($root, array $args, GraphQLContext $context)
    {
        Log::info('Resolving profile with args:', ['args' => $args]);

        $user = User::find($args['id']);

        if (!$user) {
            Log::error('User not found', ['id' => $args['id']]);
            throw new \Exception('User not found');
        }

        Log::info('User found:', ['user' => $user]);
        Log::info('User profile details:', [
            'nickName' => $user->nick_name,
            'iconUrl' => $user->icon_path,
            'discription' => $user->discription,
        ]);

        return $user;
    }
}
