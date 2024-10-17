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
        $request->merge(['user_id' => auth()->id()]);

        $data = $request->all();


        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/guides', 'public');
            $data['image'] = $imagePath;
        }
        // Convert tags array to a comma-separated string if they exist
        if (isset($data['tags'])) {
            $data['tags'] = implode(',', $data['tags']);
        } else {
            $data['tags'] = null;
        }
        $guide = GuideBP::create($data);
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
        // Find the guide by ID
        $guide = GuideBP::findOrFail($id);

        // Prepare the update data
        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'category' => $request->category,
            'tags' => $request->tags,
            'external_links' => $request->external_links,
        ];

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Store the new image in 'images/guides' directory
            $imagePath = $request->file('image')->store('images/guides', 'public');

            // Add the new image path to the data array
            $data['image'] = $imagePath;

            // Optionally, delete the old image if needed
            if ($guide->image) {
                Storage::disk('public')->delete($guide->image); // Ensure 'use Illuminate\Support\Facades\Storage;'
            }
        }

        // Update the guide
        $guide->update($data);

        return redirect()->route('guide.index')->with('success', 'Guide updated successfully.');
    }


}
