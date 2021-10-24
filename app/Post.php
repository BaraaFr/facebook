<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $guarded=[];

	public function category()
	{
		return $this->belongsTo('App\Category');
	}
	public function tags()
	{
		return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
	}
	public function comments(){
		return $this->hasMany('App\Comment');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
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
                'user_id' =>  auth()->id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }
    public function dislike($user = null, $liked=false)
    {
        $this->likes()->updateOrCreate(
            [
                'user_id' =>  auth()->id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }


    // public function isLikedBy($user_id)
    // {

    //     return (bool) $user->likes
    //         ->where('post_id', $this->id)
    //         ->where('liked', 1)
    //         ->count();
    // }

    // public function isDislikedBy(User $user)
    // {
    //     return (bool) $user->likes
    //         ->where('post_id', '=',$this->id)
    //         ->where('liked', false)
    //         ->count();
    // }
}