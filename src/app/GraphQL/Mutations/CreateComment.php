<?php

namespace App\GraphQL\Mutations;

use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class CreateComment
{
    public function __invoke($root, array $args, $context, $info)
    {
        $user_id = $context->user()->id;
        Log::info('User found:', ['user' => $user_id]);
        $postId = $args['postId'];
        $text = $args['text'];

        $comment = Comment::create([
            'user_id' => $user_id,
            'post_id' => $postId,
            'content' => $text,
        ]);

        return $comment;
    }
}
