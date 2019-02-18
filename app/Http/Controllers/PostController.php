<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Session;
use App\Tag;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    public function details($slug){

    
        $post = Post::where('slug',$slug)->first();
        $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
    	$randomPost = Post::approved()->published()->take(3)->inRandomOrder()->get();
    	return view('frontEnd.single_post',compact('post','randomPost'));
    }

    public function category_post($id){

    	 $category = Category::findOrFail($id);

      $posts = $category->posts()->approved()->published()->paginate(6);
    		
    	 return view('frontEnd.category',compact('category','posts'));
    }

        public function tag_post($id){

    	 $tag = Category::findOrFail($id);
    	 $posts = $tag->posts()->approved()->published()->paginate(6);
    	
    	 return view('frontEnd.tag',compact('tag','posts'));
    }
}
