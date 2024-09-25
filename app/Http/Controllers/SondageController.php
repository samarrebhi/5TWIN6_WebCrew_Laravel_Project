<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sondage;
class SondageController extends Controller
{

    ////pour get all
    public function index()
    {
        $sondages=Sondage::all();
        return view('Front.Sondages.listsondage',compact('sondages'));
    }
/// pour add
    public function create()
    {
        return view('Front.Sondages.createsondage');
    }


    public function store(Request $request)
    {
        $sondage=Sondage::create($request->all());
        $sondage->save();
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
        return view('Front.Sondages.showsondage',compact('sondage'));
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
        return view ('Front.Sondages.editsondage',compact('sondage'));
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
        $sondage=['titre'=>$request->titre,
            'description'=>$request->description,
            'questions'=>$request->questions,
            'created_at'=>$request->created_at,
            "start_date"=>$request->start_date,
            "end_date"=>$request->end_date,
            "response_count"=>$request->response_count
            ,"category"=>$request->category,
            "location"=>$request->location
        ];
        Sondage::whereId($id)->update($sondage);
        //sondage->save();
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
        return redirect()->route('$sondage.index')
            ->with('success','Sondage deleted successuflly');

    }


}
