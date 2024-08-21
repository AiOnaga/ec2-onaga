<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

final readonly class CreateUser
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $input = $args['input'];

        //userの作成
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'nickName' => $input['profile']['nickName'],
            'iconUrl' => $input['profile']['iconUrl'],
            'discription' => $input['profile']['discription'],
        ]);

        return $user;
    }
}
