<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subscriber(Request $request){
        $validatedData = $request->validate([
            'email' =>'required|unique:subscribers',
        ]);
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        Toastr::success('Subscription Successfully Added','Success');
        return redirect()->back();

    }
}
