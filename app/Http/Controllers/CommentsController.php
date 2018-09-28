<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
      $this->validate(request(), ['body' => 'required|min:2']);

      $post->addComment(request('body'));

      return back();
    }

    public function destroy (Comment $comment)
    {
    		if ($comment->userCanEdit(Auth::user()) || (Auth::user()->id == $comment->user_id)) {
    		    $comment->delete();
    		}
    		return back();
    }
}
