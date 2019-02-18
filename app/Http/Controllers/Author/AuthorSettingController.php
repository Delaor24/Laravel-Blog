<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorSettingController extends Controller
{
   public function index(){
    	return view('Author.seeting');
    }

    public function profile_update(Request $request){

       $this->validate($request,[
          'name'=>'required',
          'email'=>'required|email',
          
       ]);


       $image = $request->file('img');
       $slug = str_slug($request->name);
       $user = User::findOrFail(Auth::id());

       if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profiles_images')){
            	Storage::disk('public')->makeDirectory('profiles_images');
            }

            //delete old image
            if(Storage::disk('public')->exists('profiles_images/'.$user->image)){
                Storage::disk('public')->delete('profiles_images/'.$user->image);

            }
        
           $profile = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profiles_images/'.$imageName,$profile);

      }

      else{
      	$imageName = $user->image;
      }

      $user->name = $request->name;
      $user->email = $request->email;
      $user->image = $imageName;
      $user->about = $request->about;
      $user->save();
          
      Toastr::success('Profile Updated successfully :','success');

      return redirect()->back();
        

    }


    public function password_update(Request $request){
    	$this->validate($request,[
    		'old_password'=>'required',
    		'password'=>'required|confirmed'

    	]);

    	$hashPassword = Auth::user()->password;
    	if(hash::check($request->old_password,$hashPassword)){
    		if(!hash::check($request->password,$hashPassword)){
    			$user = User::find(Auth::id());
    			$user->password = hash::make($request->password);
    			$user->save();
    			Toastr::success('User Change password successfully done :','success');
    			Auth::logout();
    			return redirect()->back();
    		}
    		else{
    			Toastr::error('New password can not same old password :','error');
    			return redirect()->back();
    		}
    	}
    	else{
    		Toastr::error('Current password not match :','error');
    			return redirect()->back();
    	}
    }
}
