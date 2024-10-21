<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
     // Appliquer la permission "manage blogBack" à toutes les actions de ce contrôleur
     $this->middleware( 'role:admin');
    }
    public function index()
    {
        // Fetch categories belonging to the logged-in user
        $Categories = Category::where('user_id', Auth::id())->get();
        return view('Back.Category.indexC', compact('Categories'));
    }

    public function create()
    {
        return view('Back.Category.createC');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'quantity' => 'required|integer|min:1',
            'state' => 'required|string|in:solid,liquid,electronic,gas,other',
            'environmental_impact' => 'required|string|in:low,moderate,high,polluting,biodegradable',
        ], [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a string.',
            'name.max' => 'The category name must not exceed 100 characters.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 1.',
            'state.required' => 'The state is required.',
            'state.in' => 'The state must be one of the valid options.',
            'environmental_impact.required' => 'The environmental impact is required.',
            'environmental_impact.in' => 'The environmental impact must be one of the valid options.',
        ]);
    
        // Create a new category with the logged-in user's ID
        Category::create(array_merge($request->all(), ['user_id' => auth()->id()]));
    
        return redirect()->route('Categories.index')->with('success', 'Category added successfully!');
    }

    public function show($id)
    {
        $Category = Category::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$Category) {
            return redirect()->route('Categories.index')->with('error', 'Category not found or you do not have permission to view it.');
        }

        return view('Back.Category.showC', compact('Category'));
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$category) {
            return redirect()->route('Categories.index')->with('error', 'Category not found or you do not have permission to edit it.');
        }

        return view('Front.Category.editC', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'state' => 'required|string',
            'environmental_impact' => 'required|string',
        ]);

        $category = Category::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $category->update($request->all());

        return redirect()->route('Categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$category) {
            return redirect()->route('Categories.index')->with('error', 'Category not found or you do not have permission to delete it.');
        }

        $category->delete();

        return redirect()->route('Categories.index')->with('success', 'Category deleted successfully!');
    }

    public function showCategories()
    {
        $Categories = Category::where('user_id', Auth::id())->get();
        return view('Back.Category.indexC', compact('Categories'));
    }

    public function showdetails()
    {
        $Categories = Category::where('user_id', Auth::id())->get();
        return view('Back.Category.indexC', compact('Categories'));
    }
}
