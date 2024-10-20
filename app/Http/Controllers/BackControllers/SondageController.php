<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use App\Models\GuideBP;
use App\Models\Sondage;
use Illuminate\Http\Request;

class SondageController extends Controller
{

    public function __construct()
    {
        $this->middleware( 'role:admin');
    }
    ////pour get all

    public function index(Request $request)
    {
        // Fetch all distinct categories for the dropdown filter
        $categories = Sondage::select('category')->distinct()->pluck('category');

        // Get the selected category from the request (if any)
        $selectedCategory = $request->input('category');

        // If a category is selected, filter guides by that category
        if ($selectedCategory) {
            $sondages = Sondage::where('category', $selectedCategory)->paginate(10);
        } else {
            // If no category is selected, fetch all guides
            $sondages = Sondage::paginate(8);
        }

        // Return the view with both the guides and categories data
        return view('Back.Sondages.listsondage',compact('sondages', 'categories', 'selectedCategory'));

    }

/// pour add
    public function create()
    {  $guides = GuideBP::all();
        return view('Back.Sondages.createsondage',compact('guides'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:30',
            'description' => 'required|string|min:50',
            'category' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',

            'guide_bp_id' => 'required|exists:guide_b_p_s,id',

            'questions' => 'required',
            'questions.*.text' => 'required|string', // Each question text is required
            'questions.*.options' => 'required|array|min:2', // Each question must have at least 2 options
            'questions.*.options.*' => 'required',

        ]);

        $validatedData['user_id'] = auth()->id();




// // Store the questions as JSON in the 'questions' column
  $validatedData['questions'] = json_encode($request->questions);

        $sondage = Sondage::create($validatedData);

        session()->flash('success', 'Poll created successfully!');

        return redirect()->route('sondage.index');
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:15',
            'description' => 'required|string|min:20',
            'category' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'guide_bp_id' => 'required|exists:guide_b_p_s,id',

            'questions' => 'required',
            'questions.*.text' => 'required|string', // Each question text is required
            'questions.*.options' => 'required|array|min:2', // Each question must have at least 2 options
            'questions.*.options.*' => 'required',
        ]);


        // Encode the questions to JSON
        $validatedData['questions'] = json_encode($request->questions);

        // Update the sondage with the new data
        $sondage = Sondage::findOrFail($id);

        $sondage->update($validatedData);

        return redirect()->route('sondage.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sondage=sondage::find($id);
       // logger()->info('Fetched Questions:', $sondage->questions);
        $questions = json_decode($sondage->questions, true);
        return view('Back.Sondages.showsondage',compact('sondage','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {$guides = GuideBP::all();

        $sondage = Sondage::findOrFail($id);
        $questions = json_decode($sondage->questions, true);
        return view ('Back.Sondages.editsondage',compact('sondage','guides','questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sondage=Sondage::find($id);
        $sondage->delete();
        return redirect()->route('sondage.index')
            ->with('success','Sondage deleted successuflly');

    }
    public function showguide($id)
    {
        $poll = Sondage::with('guide')->find($id);

        // Handle the case where the poll is not found
        if (!$poll) {
            abort(404);
        }

        return view('sondages.show', compact('poll'));
    }

}
