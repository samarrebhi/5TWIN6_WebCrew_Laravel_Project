<?php

namespace App\Http\Controllers;
use App\Models\Claim;
use App\Models\Center;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims = Claim::where('user_id', auth()->id())->get();
        return view('Front.Claims.claims', compact('claims')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centers = Center::all(); 
        return view('Front.Claims.create', compact('centers')); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Validate the input data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'center_id' => 'required|exists:centers,id',
        'category' => 'required|in:service,quality,time,other', // Validate category
        'attachment' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:2048',
    ]);

    // Store the claim with the logged-in user's ID
    Claim::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'status' => 'in_progress',
        'user_id' => auth()->id(),
        'center_id' => $validatedData['center_id'],
        'category' => $validatedData['category'], // Add category
        'attachment' => $request->hasFile('attachment') ? $request->file('attachment')->store('attachments') : null,
    ]);

    return redirect()->route('claim.index')->with('success', 'Claim created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
