<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Post;


class HomeController extends Controller
{
      /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show pages and posts
        $pages = Page::all();

        $posts = Post::latest()
        ->filter(request(['month', 'year']))
        ->get();

        return view('posts.index', compact('pages', 'posts'));
    }
}
