<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,jpg,png,bmp'
        ]);

        $image = $request->file('image');
        $slug = strtolower($request->name);
        if($image){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            $category = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category);

            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            $slider = Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }else{
            $imageName = 'default.png';
        }
           $category = new Category();
           $category->name = $request->name;
           $category->slug = $slug;
           $category->image = $imageName;
           $category->save();
           Toastr::success('Category Successfully Saved','Success');
           return redirect()->route('admin.category.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoryUpdate = Category::find($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,bmp'
        ]);

        $image = $request->file('image');
        $slug = strtolower($request->name);
        if($image){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            //delete old image
            if(Storage::disk('public')->exists('category/'.$categoryUpdate->image)){
                Storage::disk('public')->delete('category/'.$categoryUpdate->image);
            }
            $category = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category);

            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //delete old slider image
            if(Storage::disk('public')->exists('category/slider/'.$categoryUpdate->image)){
                Storage::disk('public')->delete('category/slider/'.$categoryUpdate->image);
            }
            $slider = Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }else{
            $imageName = $categoryUpdate->image;
        }
        $categoryUpdate->name = $request->name;
        $categoryUpdate->slug = $slug;
        $categoryUpdate->image = $imageName;
        $categoryUpdate->save();
        Toastr::success('Category Successfully Updated','Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id);
      if(Storage::disk('public')->exists('category/'.$category->image)){
          Storage::disk('public')->delete('category/'.$category->image);
      }
        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();
        Toastr::success('Category Successfully Deleted','success');
        return redirect()->back();
    }
}
