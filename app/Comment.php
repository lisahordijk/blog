<?php

namespace App;
use App\Post;

class Comment extends Model
{

    protected $fillable = [
      'user_id',
      'body',
    ];

    public function post()
    {
      return $this->belongsTo(Post::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
