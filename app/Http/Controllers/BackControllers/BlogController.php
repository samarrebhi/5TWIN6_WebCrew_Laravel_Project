<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;



class BlogController extends Controller
{

    public function __construct()
   {
    $this->middleware( 'role:admin');
   }
 
    
    public function index()
    {
        $blogs = Blog::with('likes')
                     ->where('user_id', Auth::id()) 
                     ->orderBy('id', 'DESC')
                     ->paginate(5);
        return view('Back.Blog.list', ['blogs' => $blogs]);
    }

    public function create()  {
        return view('Back.Blog.create') ;
    }

   public function store(Request $request)
  {

    $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => ['required', 'string', 'regex:/^(\b\w+\b[\s\r\n]*){3,}$/'],
        'image' => 'sometimes|image|mimes:gif,png,jpeg,jpg|max:2048',
        'support' => 'required|string',
    ], [
        'titre.required' => 'Le titre est obligatoire.',
        'titre.string' => 'Le titre doit être une chaîne de caractères.',
        'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
        'texte.required' => 'Le texte est obligatoire.',
        'texte.string' => 'Le texte doit être une chaîne de caractères.',
        'texte.regex' => 'Le texte doit contenir au moins trois mots.',
        'image.image' => "Le fichier doit être une image.",
        'image.mimes' => "L'image doit être au format gif, png, jpeg ou jpg.",
        'image.max' => "L'image ne doit pas dépasser 2 Mo.",
        'support.required' => 'Le support est obligatoire.',
        'support.string' => 'Le support doit être une chaîne de caractères.',
    ]);

    $blog = new Blog();
    $blog->titre = $request->titre;
    $blog->texte = $request->texte;
    $blog->support = $request->support;
    $blog->user_id = Auth::id(); 
    $blog->save();


    if ($request->hasFile('image')) {
        $ext = $request->image->getClientOriginalExtension();
        $newFileName = time() . '.' . $ext;
        $request->image->move(public_path('/uploads/blogs/'), $newFileName);
        $blog->image = $newFileName;
        $blog->save();
    }

    $request->session()->flash('success', 'Blog ajouté avec succès');
    return redirect()->route('admin.listBlog');
  }

    public function edit($id) {

        $blog = Blog::findOrFail($id);

        return view('Back.Blog.edit',['blog'=>$blog]);
    }

    public function update($id, Request $request)
    {
        // Valider les champs d'entrée
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => ['required', 'string', 'regex:/^(\b\w+\b[\s\r\n]*){3,}$/'],
            'image' => 'sometimes|image|mimes:gif,png,jpeg,jpg|max:2048',
            'support' => 'required|string',
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'texte.required' => 'Le texte est obligatoire.',
            'texte.string' => 'Le texte doit être une chaîne de caractères.',
            'texte.regex' => 'Le texte doit contenir au moins trois mots.',
            'image.image' => "Le fichier doit être une image.",
            'image.mimes' => "L'image doit être au format gif, png, jpeg ou jpg.",
            'image.max' => "L'image ne doit pas dépasser 2 Mo.",
            'support.required' => 'Le support est obligatoire.',
            'support.string' => 'Le support doit être une chaîne de caractères.',
        ]);
    
        // Mettre à jour le blog
        $blog = Blog::find($id);
        $blog->titre = $request->titre;
        $blog->texte = $request->texte;
        $blog->support = $request->support;
        $blog->save();
    
        // Upload de l'image
        if ($request->hasFile('image')) {
            $oldImage = $blog->image;
    
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time() . '.' . $ext;
            $request->image->move(public_path('/uploads/blogs/'), $newFileName);
            $blog->image = $newFileName;
            $blog->save();
    
            // Supprimer l'ancienne image
            File::delete(public_path('/uploads/blogs/' . $oldImage));
        }
    
        $request->session()->flash('success', 'Blog modifié avec succès');
        return redirect()->route('admin.listBlog');
    }
    
    public function destroy($id, Request $request){
        $blog = Blog::findOrFail($id);
        File::delete(public_path().'/uploads/blogs/'.$blog->image);
        $blog->delete();

        $request->session()->flash('success','Blog successfully deleted');
        return redirect()->route('admin.listBlog');
    }

    

    public function show($id) {
        $blog = Blog::findOrFail($id);
        return view('Back.Blog.showblog', compact('blog'));
    }
    
}
