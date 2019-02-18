<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
class SubscriberController extends Controller
{
     public function store(Request $request){
    	$this->validate($request,[
            'email'=>'required|email|unique:subscribers'

    	]);

    	$subscriberEmail = new Subscriber();
    	$subscriberEmail->email = $request->email;
    	$subscriberEmail->save();

    	 Toastr::success('You subscribe successfully done :','success');
    	 return redirect()->route('home');
    }
}
