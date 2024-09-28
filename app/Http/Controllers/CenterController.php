<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers=Center::all();
        return view('Front.Centers.centers',compact('centers'));
    }


    public function showCenters()
    {
        $centers = Center::all(); 
        return view('Back.showcenters', compact('centers'));
    }

    public function showDetails($id)
    {
    $center = Center::findOrFail($id); 
    return view('Back.detailscenter', compact('center')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Front.Centers.createCenter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $center = new Center(); 

        $center->name = $request->name;
        $center->address = $request->address;
        $center->description = $request->description;
        $center->phone = $request->phone;
        $center->email = $request->email;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $center->image = $imagePath; 
        }    

        $center->save(); 

        return redirect()->route('centers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $center=center::find($id);
        return view('Front.Centers.show',compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center =Center::find($id);
        return view ('Front.Centers.edit',compact('center'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
       $request->validate([
        'name' => 'sometimes|required',
        'address' => 'sometimes|required',
        'description' => 'sometimes|required',
        'phone' => 'sometimes|required',
        'email' => 'sometimes|required|email',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $center = Center::findOrFail($id); 

    
    $center->name = $request->name ?? $center->name;
    $center->address = $request->address ?? $center->address;
    $center->description = $request->description ?? $center->description;
    $center->phone = $request->phone ?? $center->phone;
    $center->email = $request->email ?? $center->email;

    
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('img', 'public');
        $center->image = $imagePath;
    }

    $center->save(); 

    return redirect()->route('centers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info('Attempting to delete center with ID: ' . $id);
        
        $center = Center::find($id); 
        if (!$center) {
            \Log::error('Center not found with ID: ' . $id);
            return response()->json(['message' => 'Center not found'], 404);
        }
    
        $center->delete();
        return response()->json(['message' => 'Center deleted successfully']);
    }
    
}
