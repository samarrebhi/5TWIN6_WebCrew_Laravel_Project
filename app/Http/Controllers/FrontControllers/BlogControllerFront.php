<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogControllerFront extends Controller
{
    public function indexFront()  {
        // $blogs = Blog::orderBy('id','DESC')->get();

        $blogs = Blog::orderBy('id','DESC')->get();
        return view('Front.Blog.list',['blogs'=> $blogs]) ;
    }

    public function likeBlog(Request $request, $id)
    {
        $blog = Blog::find($id);
    
        if ($blog) {
            if ($request->input('liked')) {
                $blog->likes_count += 1; // Incrémenter le nombre de J'aime
            } else {
                $blog->likes_count -= 1; // Décrémenter le nombre de J'aime
            }
            $blog->save();
    
            return response()->json(['success' => true, 'likes_count' => $blog->likes_count]);
        }
    
        return response()->json(['success' => false], 404);
    }
    


}
