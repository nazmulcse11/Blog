<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        $posts = Auth::user()->posts;
        return view('author.comment',compact('posts'));
    }
    public function destroy($id){
//        Comment::findOrFail($id)->delete();
        $comment = Comment::findOrFail($id);
        if($comment->post->user->id == Auth::id()){
            $comment->delete();
            Toastr::success('Comment Successfully Deleted','Success');
        }else{
            Toastr::error('You Are Not Authorized','Error');
        }
        return redirect()->back();
    }
}
