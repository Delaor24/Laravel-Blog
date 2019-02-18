<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
class FavariteController extends Controller
{
    public function index(){
    	$posts = Auth::user()->favarite_posts;
    	return view('Admin.favarite',compact('posts'));

    }
}
