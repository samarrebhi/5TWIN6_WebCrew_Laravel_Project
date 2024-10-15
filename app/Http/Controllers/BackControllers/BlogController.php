<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


//////

class BlogController extends Controller
{



    public function __construct()
   {
    // Appliquer la permission "manage blogBack" à toutes les actions de ce contrôleur
    $this->middleware( 'role:admin');
   }

 
    // public function index() {
    //     // Charger les blogs avec les utilisateurs qui ont aimé
    //     $blogs = Blog::with('likes')->orderBy('id', 'DESC')->paginate(5);
    //     return view('Back.Blog.list', ['blogs' => $blogs]);
    // }
    
    
    
    public function index()
    {
        // Récupérer les blogs de l'utilisateur connecté et les utilisateurs qui ont aimé
        $blogs = Blog::with('likes')
                     ->where('user_id', Auth::id()) // Afficher uniquement les blogs de l'utilisateur connecté
                     ->orderBy('id', 'DESC')
                     ->paginate(5);
        return view('Back.Blog.list', ['blogs' => $blogs]);
    }

    public function create()  {
        return view('Back.Blog.create') ;
    }
    public function store(Request $request){
        $messages = [
            'texte.regex' => 'The text field must contain at least three words.',
        ];

        $validator = Validator::make($request->all(),[
            'titre' => 'required',
            'texte' => ['required', 'regex:/^(\b\w+\b[\s\r\n]*){3,}$/'], // Minimum de 3 mots
            'image' => 'sometimes|image:gif,png,jpeg,jpg',
            'support' => 'required',
        ], $messages);

        if( $validator->passes() ){

            $blog = new Blog();
            $blog->titre = $request->titre ;
            $blog->texte = $request->texte ;
            $blog->support = $request->support ;
            $blog->user_id = Auth::id(); 
            $blog->save();

            // upload image
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/blogs/',$newFileName);
                $blog->image = $newFileName;
                $blog->save();
            }

            $request->session()->flash('success','Blog added successfully');
            return redirect()->route('admin.listBlog');

        }else{
            return redirect()->route('admin.createBlog')->withErrors($validator)->withInput();
        }
    }

    public function edit($id) {

        $blog = Blog::findOrFail($id);

        // if(!$blog) {
        //     abort('404');
        // }
        // dd($blog);

        return view('Back.Blog.edit',['blog'=>$blog]);
    }

    public function update($id, Request $request) {

        $messages = [
            'texte.regex' => 'The text field must contain at least three words.',
        ];

        $validator = Validator::make($request->all(),[
            'titre' => 'required',
            'texte' => ['required', 'regex:/^(\b\w+\b[\s\r\n]*){3,}$/'], // Minimum de 3 mots
            'image' => 'sometimes|image:gif,png,jpeg,jpg',
            'support' => 'required',
        ], $messages);

        if( $validator->passes() ){

            $blog = Blog::find($id);
            $blog->titre = $request->titre ;
            $blog->texte = $request->texte ;
            $blog->support = $request->support ;
            $blog->save();

            // upload image
            if($request->image){
                $oldImage = $blog->image;

                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/blogs/',$newFileName);
                $blog->image = $newFileName;
                $blog->save();

                File::delete(public_path().'/uploads/blogs/'.$oldImage);
            }

            $request->session()->flash('success','Blog successfully changed');
            return redirect()->route('admin.listBlog');

        }else{
            return redirect()->route('admin.blog.edit',$id)->withErrors($validator)->withInput();
        }

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
