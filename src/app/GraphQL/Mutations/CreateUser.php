<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Log;
use App\Models\User;

final readonly class CreateUser
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $input = $args['input'];
        $profileData = $input['profile'];
        // Emailが既に存在するかを確認
        $existingUser = User::where('email', $input['email'])->first();

        if ($existingUser) {
            throw new \Exception('The email address is already registered.');
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'nick_name' => $profileData['nickName'],
            'icon_path' => $profileData['iconUrl'],
            'discription' => $profileData['discription'],
        ]);

        return $user;
    }
}
