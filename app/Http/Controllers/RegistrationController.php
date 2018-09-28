<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Mail\Welcome;
use App\Http\Requests\RegistrationRequest;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
      return view('registration.create');
    }

    public function store(RegistrationRequest $request)
    {
      $request->persist();

      session()->flash('message', 'Thanks so much for signing up!');

      return redirect()->home();
    }
}
