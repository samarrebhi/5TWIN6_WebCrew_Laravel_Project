<?php

namespace App\Http\Controllers\BackControllers;

use App\Http\Controllers\Controller;
use App\Models\Sondage;
use Illuminate\Http\Request;

class SondageController extends Controller
{


    ////pour get all
    public function index()
    {
        $sondages=Sondage::all();
        return view('Back.Sondages.listsondage',compact('sondages'));

    }
/// pour add
    public function create()
    {
        return view('Back.Sondages.createsondage');
    }


    public function store(Request $request)
    {
        $sondage=Sondage::create($request->all());
        $sondage->save();
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
        $sondage=['title'=>$request->title,
            'description'=>$request->description,
            'questions'=>$request->questions,

            "start_date"=>$request->start_date,
            "end_date"=>$request->end_date,

            "category"=>$request->category,

        ];
        Sondage::whereId($id)->update($sondage);

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
    ////for the front  polls listing


}
