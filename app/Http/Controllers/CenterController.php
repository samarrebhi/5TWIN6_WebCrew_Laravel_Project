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
        
        $centers = Center::where('user_id', auth()->id())->get();
 
        return view('Back.showcenters', compact('centers'));
    }

    public function showDetails($id)
    {
    $center = Center::where('id', $id)->where('user_id', auth()->id())->firstOrFail(); 
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
            'name' => ['required', 'string','min:2','max:40'],
            'address' => ['required','min:2'],
            'description' => ['required','min:10','max:200'],
            'phone' => 'required|integer',
            'email' => 'required|email',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        Center::create([
            
            'name' =>$request->name,
            'address' => $request->address,
            'description' =>  $request->description,
            'phone' =>  $request->phone,
            'email' =>  $request->email,
            'image' => $request->file('image')->store('img', 'public'),
            'user_id' => auth()->id(),
        ]);


        return redirect()->route('centers.index')->with('success', 'Center created successfully!');;
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
        $center = Center::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
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
            'name' => [ 'string','min:2','max:40'],
            'address' => ['min:2'],
            'description' => ['min:10','max:200'],
            'phone' => 'integer',
            'email' => 'email',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
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
        
        $center = Center::where('id', $id)->where('user_id', auth()->id())->firstOrFail(); 
        if (!$center) {
            \Log::error('Center not found with ID: ' . $id);
            return response()->json(['message' => 'Center not found'], 404);
        }
    
        $center->delete();
        return response()->json(['message' => 'Center deleted successfully']);
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Chercher les centres où le nom correspond à la requête
    $centers = Center::where('name', 'like', '%' . $query . '%')->get();

    // Retourner la vue avec les résultats de recherche
    return view('centers.index', compact('centers'));
}
    
}
