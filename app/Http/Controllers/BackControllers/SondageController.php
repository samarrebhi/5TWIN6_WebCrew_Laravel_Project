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
    public function index()
    {
        $sondages=Sondage::all();
        return view('Back.Sondages.listsondage',compact('sondages'));

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
            'questions' => 'required|string',
            'guide_bp_id' => 'required|exists:guide_b_p_s,id',

        ]);

        $validatedData['user_id'] = auth()->id();

        $sondage = Sondage::create($validatedData);

        session()->flash('success', 'Poll created successfully!');

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
        return view('Back.Sondages.showsondage',compact('sondage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sondage =Sondage::find($id);
        return view ('Back.Sondages.editsondage',compact('sondage'));
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:15',
            'description' => 'required|string|min:20',
            'category' => 'required|alpha',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'questions' => 'required|string',
        ]);

        Sondage::whereId($id)->update($validatedData);

        return redirect()->route('sondage.index');
    }


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
