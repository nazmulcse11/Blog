<?php

namespace App\Http\Controllers;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        $validatedData = $request->validate([
            'comment' => 'required',
        ]);

        $comment = new Comment();
        $comment->post_id = $id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        Toastr::success('Comment Successfully Send','Success');
        return redirect()->back();

    }

}
