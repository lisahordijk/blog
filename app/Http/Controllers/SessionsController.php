<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Page;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest', ['except' => 'destroy']);
    }

    // creeer inlog sessie
    public function create()
    {
      $pages = Page::all();

      return view('sessions.create')->with('pages', $pages);
    }

    // check inlog gegevens
    public function store()
    {
       if (! auth()->attempt(request(['email', 'password']))) {
         return back()->withErrors([
           'message' => 'Please check your credentials and try again.'
         ]);
       }

       return redirect()->home();
    }

    // uitloggen
    public function destroy()
    {
      auth()->logout();

      return redirect()->home();
    }
}
