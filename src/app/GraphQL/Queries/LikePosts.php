<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Mutations\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class LikePosts
{
    public function __invoke($root, array $args, GraphQLContext $context)
    {

        $user = $context->user();
        //ログインユーザーのいいねしたpostを取得
        $likes = $user->likes()->get();
        //ポリモーフィックリレーションのため、postとcommentのいいねを取得。
        //複数のモデルを取得するため、mapメソッドを使用
        $posts = $likes->map(function ($like) {
            $likeable = $like->likeable;
            return $likeable;
            Log::info('Likeable found:', ['likeable' => $post]);
        });
        // Log::info('Likes found:', ['likes' => $posts]);

        return [
            'posts' => $posts,
        ];

    }

}
