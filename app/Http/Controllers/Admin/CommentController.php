<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('admin.comment',compact('comments'));
    }
    public function destroy($id){
//        Comment::findOrFail($id)->delete();
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Toastr::success('Comment Successfully Deleted','Success');
        return redirect()->back();
    }
}
