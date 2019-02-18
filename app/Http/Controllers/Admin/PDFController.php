<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Post;
use App\User;
class PDFController extends Controller
{
    public function pdfPost(){
    	$posts = Post::all();
    	
    	$pdf = PDF::loadView('Admin.post.pdfPost',compact('posts'));
    	return $pdf->stream('Admin.post.pdfPost.pdf');

    }
}
