<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontCategController extends Controller
{
    public function index()
    {
        // Fetch categories belonging to the logged-in user
        $Categories = Category::where('user_id', Auth::id())->get();
        return view('Front.Category.indexC', compact('Categories'));
    }

    public function show($id)
    {
        $Category = Category::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$Category) {
            return redirect()->route('Categories.index')->with('error', 'Category not found or you do not have permission to view it.');
        }

        return view('Front.Category.showC', compact('Category'));
    }

}
