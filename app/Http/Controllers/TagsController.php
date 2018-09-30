<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Page;

class TagsController extends Controller
{
    // laat tags zien
    public function index(Tag $tag)
    {
      $posts = $tag->posts;

      return view('posts/index', compact('posts'));
    }

}
