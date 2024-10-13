<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogLike; 
use Illuminate\Support\Facades\Auth;

class BlogControllerFront extends Controller
{
    public function indexFront()  
    {
        $blogs = Blog::orderBy('id', 'DESC')->get();
        return view('Front.Blog.list', ['blogs' => $blogs]);
    }

     // Fonction pour gérer le like / unlike
     public function likeBlog($id)
     {
         $blog = Blog::findOrFail($id);
         $user = Auth::user();
         
         // Vérifier si l'utilisateur a déjà aimé le blog
         $like = BlogLike::where('blog_id', $blog->id)
                         ->where('user_id', $user->id)
                         ->first();
         
         if ($like) {
             // Si un like existe, c'est un dislike -> On le supprime et décrémente
             $like->delete();
             
             // Décrémenter le compteur de likes, mais vérifier qu'il reste >= 0
             if ($blog->like_count > 0) {
                 $blog->decrement('like_count');
             }
         } else {
             // Si pas de like existant, on ajoute un like et on incrémente
             BlogLike::create([
                 'blog_id' => $blog->id,
                 'user_id' => $user->id,
             ]);
             $blog->increment('like_count');
         }
     
         // Sauvegarder explicitement le blog après l'incrémentation ou décrémentation
         $blog->save();
     
         return response()->json([
             'like_count' => $blog->like_count,
         ]);
     }
     

}


