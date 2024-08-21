<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Viewer
{
    public function __invoke($root, array $args, GraphQLContext $context)
    {
        //ログインユーザーの情報を取得
        $user = $context->user();

        // デバッグのために、取得したユーザー情報をログに記録
        if ($user) {
            Log::info('User found:', ['user' => $user]);
        } else {
            Log::error('User not found');
            throw new \Exception('User not found');
        }

        // 取得したユーザーを返す
        return $user;
    }
}
