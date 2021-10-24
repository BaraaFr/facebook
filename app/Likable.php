<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likable
{   
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function scopeWithLikes(Builder $query)
    {
         $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }   

    
    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate(
            [
                'user_id' => $user ? $user->id : auth()->id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }
    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

}