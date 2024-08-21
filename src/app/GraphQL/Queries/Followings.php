<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Followings
 * @package App\GraphQL\Queries
 */
class Followings
{
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // ログインユーザーの情報を取得
        $user = User::find( $args['userId']);
        Log::info('User found:', ['user' => $user]);

        // ログインユーザーがフォローしているユーザーを取得
        $followings = $user->followings()->get();
        Log::info('Followings found:', ['followings' => $followings]);

        return $followings;
    }
}
