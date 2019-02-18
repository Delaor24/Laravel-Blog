<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class FavariteController extends Controller
{
    public function index(){
    	$posts = Auth::user()->favarite_posts;
    	return view('author.favarite',compact('posts'));

    }
}
