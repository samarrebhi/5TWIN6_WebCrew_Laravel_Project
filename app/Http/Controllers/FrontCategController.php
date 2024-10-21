<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontCategController extends Controller
{
    public function index()
    {
        $Categories=Category::all();
        return view('Front.Category.indexC',compact('Categories'));    }


   public function show($id)
    {
        $Category=Category::find($id);
        return view('Front.Category.showC',compact('Category'));
    }


}
