<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;

final readonly class Logout
{
    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard();

        $user = $guard->user();
        $guard->logout();

        return $user;
    }
}
