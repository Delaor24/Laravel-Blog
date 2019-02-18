<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;

class FrontEndController extends Controller
{
    public function index(){
    	$posts = Post::latest()->approved()->published()->take(6)->get();
       $categories = Category::all();
    	return view('frontEnd.index',compact('categories','posts'));
    }

    public function all_posts(){
    	$posts = Post::latest()->approved()->published()->paginate(9);
    	return view('frontEnd.posts',compact('posts'));

    }
}
