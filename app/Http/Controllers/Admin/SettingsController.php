<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.setting');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' =>'required',
            'email' =>'required|email',
            'image' =>'required|image',
        ]);
        $image = $request->file('image');
        $slug = strtolower($request->name);
        $user = User::findOrFail(Auth::id());

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }

            if(Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }

            $profile_image = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$profile_image);
        }else{
            $imageName = 'default.png';
        }
        $user->name = $request->name;
        $user->slug = $slug;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;

        $user->save();
        Toastr::success('Profile Successfully Updated','Success');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword))
        {
            if(!Hash::check($request->password,$hashedPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed','Success');
                Auth::logout();
                return redirect()->back();
            }else{
                Toastr::error('New Password Can Not Be The Same As Old Password','Error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Current Pasword Does Nont Match','error');
            return redirect()->back();
        }
    }
}
