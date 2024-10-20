<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use App\Models\GuideBP;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
//
class GuideBackController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'role:admin');
    }

    public function index(Request $request)
    {
        // Fetch all distinct categories for the dropdown filter
        $categories = GuideBP::select('category')->distinct()->pluck('category');

        // Get the selected category from the request (if any)
        $selectedCategory = $request->input('category');

        // If a category is selected, filter guides by that category
        if ($selectedCategory) {
            $guides = GuideBP::where('category', $selectedCategory)->paginate(10);
        } else {
            // If no category is selected, fetch all guides
            $guides = GuideBP::paginate(8);
        }

        // Return the view with both the guides and categories data
        return view('Back.GuideBP.listguide', compact('guides', 'categories', 'selectedCategory'));
    }

    public function create()
    {
        return view('Back.GuideBP.createguide');
    }

    public function show($id)
    {
        $guide =GuideBP::find($id);
        return view('Back.GuideBP.detailsguide',compact('guide'));
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'body' => 'required|string|min:100|max:300',
            'tags' => 'required|array|min:3',
            'category'=>'required',
            'external_links' => 'nullable|url',
            'image' => 'image',
        ]);


        $validatedData['user_id'] = auth()->id();


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/guides', 'public');
            $validatedData['image'] = $imagePath;
        }


        if (isset($validatedData['tags'])) {
            $validatedData['tags'] = implode(',', $validatedData['tags']);
        } else {
            $validatedData['tags'] = null;
        }


        $guide = GuideBP::create($validatedData);


        return redirect()->route('guide.index')->with('success', 'Guide created successfully.');
    }









    public function destroy($id)
    {
        $guide =GuideBP::find($id);
        $guide->delete();
        return redirect()->route('guide.index')
            ->with('success','Best practice guide deleted successuflly');

    }
    public function edit($id)
    {
        $guide =GuideBP::find($id);
        return view ('Back.GuideBP.editguide',compact('guide'));
    }
    public function update(Request $request, $id)
    {
        $guide = GuideBP::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'body' => 'required|string|min:100|max:300',
            'category' => 'required',
            'tags' => 'required|array|min:3',
            'external_links' => 'nullable|url',
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            // Stocker la nouvelle image dans le répertoire 'images/guides'
            $imagePath = $request->file('image')->store('images/guides', 'public');
            $validatedData['image'] = $imagePath;

            if ($guide->image) {
                Storage::disk('public')->delete($guide->image);
            }
        }

        if (isset($validatedData['tags'])) {
            $validatedData['tags'] = implode(',', $validatedData['tags']);
        } else {
            $validatedData['tags'] = null;
        }

        $guide->update($validatedData);
        return redirect()->route('guide.index')->with('success', 'Guide updated successfully.');
    }

    public function showpoll($id)
    {
        $guide = GuideBP::with('sondage')->find($id);

        // Handle the case where the guide is not found
        if (!$guide) {
            abort(404);
        }

        return view('guides.show', compact('guide'));
    }

}
