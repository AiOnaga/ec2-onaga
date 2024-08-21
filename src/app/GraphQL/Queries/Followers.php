<?php

namespace App\GraphQL\Queries;

use App\Models\User;

class Followers
{
    public function __invoke($root, array $args)
    {
        // ログインユーザーの情報を取得
        $user = User::find($args['userId']);

        // ログインユーザーをフォローしているユーザーを取得
        $followers = $user->followers()->get();

        return $followers;
    }
}
