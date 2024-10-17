<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use App\Models\GuideBP;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

//
class GuideBackController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'role:admin');
    }
    public function index()
    {
        $guides=GuideBP::all();
        return view('Back.GuideBP.listguide',compact('guides'));

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
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'array|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $data = $validatedData; // Use validated data

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/guides', 'public');
            $data['image'] = $imagePath; // Save image path in the data array
        }

        // Convert tags array to a comma-separated string if they exist
        if (isset($data['tags'])) {
            $data['tags'] = implode(',', $data['tags']);
        } else {
            $data['tags'] = null;
        }

        // Add the logged-in user's ID
        $data['user_id'] = auth()->id(); // Assuming user is authenticated

        // Create the GuideBP instance with the user_id included
        $guide = GuideBP::create($data);

        return redirect()->route('guide.index')->with('success', 'Guide created successfully.'); // Redirect with a success message
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
        $guide = [
            'title' => $request->title,
            'body' => $request->body,
            'category' => $request->category,
            'tags' => $request->tags,
            'image' => $request->image,
            'external_links' => $request->external_links,
        ];


        GuideBP::whereId($id)->update($guide);

        return redirect()->route('guide.index')->with('success', 'Guide updated successfully.');
    }

}
