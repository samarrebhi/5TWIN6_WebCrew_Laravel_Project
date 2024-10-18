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
        'category' => 'required|in:service,quality,time,other', 
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
       
    $claim = Claim::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $centers = Center::all();
    return view('Front.Claims.edit', compact('claim', 'centers')); 
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
      // Retrieve the claim that belongs to the logged-in user
    $claim = Claim::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    // Validate the input data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'center_id' => 'required|exists:centers,id',
        'category' => 'required|in:service,quality,time,other', // Validate category
        'attachment' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:2048', // Optional attachment
    ]);

    // Update the claim
    $claim->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'center_id' => $validatedData['center_id'],
        'category' => $validatedData['category'],
        'attachment' => $request->hasFile('attachment') ? $request->file('attachment')->store('attachments') : $claim->attachment,
    ]);

    return redirect()->route('claim.index')->with('success', 'Claim updated successfully.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { $claim = Claim::findOrFail($id);

        // Check if the authenticated user is the owner of the claim
        if ($claim->user_id !== auth()->id()) {
            return redirect()->route('claim.index')->with('error', 'You are not authorized to delete this claim.');
        }
    
        // Delete the claim
        $claim->delete();
    
        return redirect()->route('claim.index')->with('success', 'Claim deleted successfully.');
    }
}
