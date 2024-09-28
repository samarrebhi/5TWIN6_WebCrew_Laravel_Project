<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories=Category::all();
        return view('Front.Category.indexC',compact('Categories'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Front.Category.createC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'state' => 'required|string',
            'environmental_impact' => 'required|string',
        ]);

        // Create a new category using the validated data
        Category::create($request->all());

        // Redirect back with a success message
        return redirect()->route('Categories.index')->with('success', 'Category added successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Category=Category::find($id);
        return view('Front.Category.showC',compact('Category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
    
        if ($category) {
            return view('Front.Category.editC', compact('category'));
        }
        
        return redirect()->route('Category.indexC')->with('error', 'Category not found');
    }
    
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'state' => 'required|string',
            'environmental_impact' => 'required|string',
        ]);
    
        // Find the category by ID
        $category = Category::findOrFail($id);
    
        // Update fields with the new values or keep existing ones
        $category->name = $request->name ?? $category->name;
        $category->quantity = $request->quantity ?? $category->quantity;
        $category->state = $request->state ?? $category->state;
        $category->environmental_impact = $request->environmental_impact ?? $category->environmental_impact;
    
        // Save the updated category
        $category->save();
    
        // Redirect back to the index page with a success message
        return redirect()->route('Categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('Categories.index')->with('success', 'Category deleted successfully');
        }
    
        return redirect()->route('Categories.index')->with('error', 'Category not found');
    }
    
}
