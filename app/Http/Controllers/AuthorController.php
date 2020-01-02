<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function profile($username){
    	// return $posts = User::where('username',$username)->first()->posts()
    	//                  ->approved()->published()->get();

      $author = User::where('username',$username)->first();
      $posts = $author->posts()->approved()->published()->get();
      return view('profile',compact('author','posts'));

    }
}
