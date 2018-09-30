<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    // validate and store posts
    public function store(Post $post)
    {
      $this->validate(request(), ['body' => 'required|min:2']);

      $post->addComment(request('body'));

      return back();
    }

    // de comment kan worden geedit
    public function update (Post $post, Comment $comment)
    {
        $this->validate(request(),[
          'body' => 'required'
          ]);

        $comment->update(request([
          'body']));

        return back();
    }

    // de comment kan worden verwijderd
    public function destroy (Comment $comment)
    {
    		$comment->delete();

    		return back();
    }
}
