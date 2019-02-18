<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::latest()->get();

        return view('Admin.category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:categories',
             'img'=>'required|mimes:jpeg,png,jpg,bmp'
        ]);


         //get image
        $image = $request->file('img');
        $slug = str_slug($request->name);
        if(isset($image)){
            //make qnique name for image

            $currentData = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentData.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check category folder is exist? 
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            //resize image and image upload
            $category = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category);

            //check slider folder is exist? 
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            //resize image and image upload
            $slider = Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }
        else{
            $imageName = 'default.png';
        }

         $category = new Category();
         $category->name = $request->name;
         $category->slug = $slug;
         $category->image = $imageName;
         $category->save();

         Toastr::success('Category Insert successfully :','success');

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
        return view('Admin.category.edit',compact('category'));
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
        $this->validate($request,[
            'name'=>'required',
             'img'=>'mimes:jpeg,png,jpg,bmp'
        ]);


      


        $image = $request->file('img');
        $slug = str_slug($request->name);
        $category = Category::find($id);
        if(isset($image)){
            //make qnique name for image

            $currentData = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentData.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check category folder is exist? 
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            //delete old image
            if(Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/'.$category->image);

            }

        
            //resize image and image upload
            $categoryImage = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$categoryImage);

            //check slider folder is exist? 
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            //delete old slider image
            if(Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);

            }
            //resize image and image upload
            $slider = Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }
        else{
            $imageName = $category->image;
        }

        
         $category->name = $request->name;
         $category->slug = $slug;
         $category->image = $imageName;
         $category->save();

         Toastr::success('Category Update successfully :','success');

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
        $category =  Category::find($id);
        if(Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
        }

        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }
        $category->delete();
        Toastr::success('Category Deleted successfully :','success');
        return redirect()->back();
    }
}
