<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function add($post){
      $user = Auth::user();
      $favourite = $user->favourite_posts()->where('post_id',$post)->count();
      if($favourite == 0){
          $user->favourite_posts()->attach($post);
          Toastr::success('Successfully add to favourite list','Success');
          return redirect()->back();
      }else{
          $user->favourite_posts()->detach($post);
          Toastr::success('Successfully remove from favourite list','Success');
          return redirect()->back();
      }
    }
}
