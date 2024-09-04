<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Interfaces\Likable;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final readonly class Like
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

        if (!$user) {
            throw new \Exception('Unauthenticated.');
        }

        $targetId = $args['targetId'];
        Log::info('Like target id:', ['targetId' => $targetId]);
        $type = $args['type'];
        Log::info('Like target type:', ['type' => $type]);
        //postの場合
        if ($type === 'post') {
            $target = $post = Post::find($targetId);
            if (!$post) {
                throw new \Exception('Post not found.');
            }
            $like = $post->likes()->where('user_id', $user->id)->first();
            if ($like) {
                $like->delete();
            } else {
                $post->likes()->create(['user_id' => $user->id]);
            }
        } else {
            //commentの場合
            $target = $comment = Comment::find($targetId);
            if (!$comment) {
                throw new \Exception('Comment not found.');
            }
            $like = $comment->likes()->where('user_id', $user->id)->first();
            if ($like) {
                $like->delete();
            } else {
                $comment->likes()->create(['user_id' => $user->id]);
            }
        }
        return ['likable' => $target];
    }
}
