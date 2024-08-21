<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final readonly class LikePosts
{
    /**
     * @param                $root
     * @param array          $args
     * @param GraphQLContext $context
     * @return array
     * @throws \Exception
     *
     */
    public function __invoke($root, array $args, GraphQLContext $context)
    {
        //ログインユーザー
        $guard = Auth::guard();
        $user = $guard->user();

        Log::info('User found:', ['user' => $user]);

        if (!$user) {
            throw new \Exception('Unauthenticated.');
        }

        //ログインユーザーがいいねした投稿を取得
        $posts = $user->posts->likes()->get();

        return $posts;

    }
}
