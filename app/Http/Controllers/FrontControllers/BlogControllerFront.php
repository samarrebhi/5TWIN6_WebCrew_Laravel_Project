<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogControllerFront extends Controller
{
    public function indexFront()  {
        // $blogs = Blog::orderBy('id','DESC')->get();

        $blogs = Blog::orderBy('id','DESC')->paginate(5);
        return view('Front.Blog.list',['blogs'=> $blogs]) ;
    }

}
