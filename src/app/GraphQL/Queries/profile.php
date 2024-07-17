<?php

namespace App\GraphQL\Queries;

use App\Models\User;

final class Profile
{
    public function __invoke($root, array $args, $context)
    {
        $user = User::where('id', $args['id'])->first();

        return [
            'nickName' => $user->name,
            'iconUrl' => $user->icon_path ? url($user->icon_path) : null,
            'discription' => 'test-discription',
        ];
    }
}
