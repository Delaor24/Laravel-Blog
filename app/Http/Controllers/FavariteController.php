<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class FavariteController extends Controller
{
    public function add($post){
       $user = Auth::user();
       $favarite = $user->favarite_posts()->where('post_id',$post)->count();

       if($favarite == 0){
       	  $user->favarite_posts()->attach($post);
       	  Toastr::success('Your favarite list successfully added :','success');
       	  return redirect()->back();
       }
       else{
       	   $user->favarite_posts()->detach($post);
       	  Toastr::error('Your favarite list successfully remove :','error');
       	  return redirect()->back();
       }

    }

    
}
