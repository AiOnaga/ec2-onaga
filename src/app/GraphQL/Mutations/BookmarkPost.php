<?php

namespace App\GraphQL\Mutations;

use App\Models\Bookmark;
use App\Models\Post;

class BookmarkPost
{
    public function __invoke($root, array $args, $context, $info)
    {
        $user_id = $context->user()->id;
        $postId = $args['postId'];
        $post = Post::find($postId);
        //ブックマークされているか確認
        $bookmark = Bookmark::where('user_id', $user_id)->where('post_id', $postId)->first();
        //ブックマークされている場合は削除
        if ($bookmark) {
            $bookmark->delete();
        }
        //ブックマークされていない場合は新規登録
        if(! $bookmark){
            Bookmark::create([
                'user_id' => $user_id,
                'post_id' => $postId,
            ]);
        }

        return $post;
    }
}
