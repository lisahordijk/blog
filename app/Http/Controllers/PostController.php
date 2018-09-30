<?php

namespace App\Http\Controllers;
use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;
use App\User;
use App\Page;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index', 'show']);
    }

    // laat de posts zien
    public function index(Post $post)
    {
      $posts = Post::latest()
        ->filter(request(['month', 'year']))
        ->get();

      return view('posts/index', compact('posts'));
    }

    public function show(Post $post)
    {
      $pages = Page::all();

      return view('posts.show', compact('post', 'pages'));
    }

    // maak nieuwe post
    public function create()
    {
      $pages = Page::all();

      return view('posts.create')->with('pages', $pages);
    }

    // sla post op
    public function store()
    {
      $this->validate(request(), [

        'title' => 'required',
        'body' => 'required'
      ]);

      auth()->user()->publish(
        new Post(request(['title', 'body']))
      );

      session()->flash(

        'message', 'Your post has been published.'
      );

      return redirect('/');

    }

    // delete post
    public function destroy(Post $post)
    {
      $post->delete();

      return redirect('/');
    }
}
