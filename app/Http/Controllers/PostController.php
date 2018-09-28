<?php

namespace App\Http\Controllers;
use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;
use App\User;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Post $post)
    {
      // $posts = $posts->all();

      // return session('message');

      // return $tag->posts;

      $posts = Post::latest()
        ->filter(request(['month', 'year']))
        ->get();

      // $archives = Post::archives();

      return view('posts/index', compact('posts'));
    }

    public function show(Post $post)
    {
      // $archives = Post::selectRaw(‘year(created_at) year, monthname(created_at) month, count(*) published’)
      // ->groupBy(‘year’, ‘month’)
      // ->orderBy('min(created_at)')
      // ->get()
      // ->toArray();

      return view('posts/show', compact('post'));
    }

    public function create()
    {
      return view('posts/create');
    }

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

      // create post
      // Post::create([
      //   'title' => request('title'),
      //   'body' => request('body'),
      //   'user_id' => auth()->id()
      // ]);

      // redirect to home page
      return redirect('/');

    }
}
