<?php

namespace App\Http\Controllers\Admin;

use App\Category;

use App\Subscriber;
use App\Tag;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Notifications\AuthorPostApprove;
use App\Notifications\NewPostNotify;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::latest()->get();
        return view('Admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags= Tag::all();
        return view('Admin.post.create',compact('categories','tags'));
        
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
            'title' => 'required',
            'img' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('img');
        $slug = str_slug($request->title);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        } else {
            $imageName = "default.png";
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $Subscribers = Subscriber::all();

        foreach($Subscribers as $Subscriber){
           Notification::route('mail',$Subscriber->email)->notify(new NewPostNotify($post));
        }



        Toastr::success('Post insert Successfully :','success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {


        return view('Admin.post.view',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('Admin.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,['title' => 'required',
            'img' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('img');
        $slug = str_slug($request->title);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
//            delete old post image
            if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        } else {
            $imageName = $post->image;
        }
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated :)','Success');
        return redirect()->route('admin.post.index');
    }

//..............post approve................

    public function approval($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false)
        {
            $post->is_approved = true;
            $post->save();
            
            
            Toastr::success('Post Successfully Approved :)','Success');


           $post->user->notify(new AuthorPostApprove($post));
           
           $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber){
                 Notification::route('mail',$subscriber->email)->notify(new NewPostNotify($post));

            }
            
               
            


        } 
        else {
            Toastr::info('This Post is already approved','Info');
        }
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();

        $post->delete();
        Toastr::success('Post Delete Successfully :','success');
        return redirect()->back();
    }

    public function pending(){
        $posts = Post::where('is_approved',false)->get();
        return view('Admin.post.pending',compact('posts'));
    }
}
